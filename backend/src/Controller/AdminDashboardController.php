<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\MailerService;
use DateTimeImmutable;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Repository\UserRepository;



#[Route('/api', name: 'app_api_')]
class AdminDashboardController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager,
    private SerializerInterface $serializer,
    private MailerService $mailerService,
    private UserPasswordHasherInterface $passwordHasher
)
    {
    }

    #[Route('/admin/create-user', name: 'api_create_user', methods: ['POST'])]
    public function createUser(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        return $this->json([
        'body_raw' => $request->getContent(),
        'post' => $request->request->all(),
        'json' => json_decode($request->getContent(), true)
    ]);
    
        $data = json_decode($request->getContent(), true);

        if (!isset($data['email'], $data['password'], $data['role'])) {
            return new JsonResponse(['error' => 'Missing fields'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Vérifier si l'email existe déjà
        $existingUser = $this->manager->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if ($existingUser) {
            return new JsonResponse(['error' => 'Email already in use'], JsonResponse::HTTP_CONFLICT);
        }

        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        $user->setRoles([$data['role']]);
        $user->setApiToken(bin2hex(random_bytes(32)));

        $this->manager->persist($user);
        $this->manager->flush();



        return new JsonResponse(
            [
                'message' => 'User created successfully!',
                'user' => $user->getUserIdentifier(),
                'apiToken' => $user->getApiToken(),
                'roles' => $user->getRoles()
            ],
            JsonResponse::HTTP_CREATED
        );
    }




    #[Route('/admin/users', name: 'get_users', methods: ['GET'])]
    public function listUsers(UserRepository $userRepository): JsonResponse
    {
        $users = $userRepository->findAll();
        $data = array_map(function (User $user) {
            return [
                'email' => $user->getEmail(),
                'role' => $user->getRoles()[0] ?? 'N/A'
            ];
        }, $users);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/admin/users/{email}', name: 'update_user', methods: ['PUT'])]
    public function updateUser(Request $request, UserRepository $userRepository, string $email): JsonResponse
    {
        $user = $userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur introuvable'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['password'])) {
            $hashedPassword = $this->passwordHasher->hashPassword($user, $data['password']);
            $user->setPassword($hashedPassword);
        }

        if (isset($data['role'])) {
            $user->setRoles([$data['role']]);
        }

        $this->manager->flush();

        return new JsonResponse(['message' => 'Utilisateur mis à jour avec succès'], Response::HTTP_OK);
    }

    #[Route('/admin/users/{email}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(UserRepository $userRepository, string $email): JsonResponse
    {
        $user = $userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur introuvable'], Response::HTTP_NOT_FOUND);
        }

        $this->manager->remove($user);
        $this->manager->flush();

        return new JsonResponse(['message' => 'Utilisateur supprimé avec succès'], Response::HTTP_OK);
    }
}
