<?php

namespace App\Controller;

use App\Entity\ContactRequest;
use App\Repository\ContactRequestRepository;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ContactController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private MailerService $mailer;

    public function __construct(EntityManagerInterface $entityManager, MailerService $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    #[Route('/api/contact', name: 'api_contact_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $contact = new ContactRequest();
        $contact->setTitle($data['title'] ?? '');
        $contact->setDescription($data['description'] ?? '');
        $contact->setEmail($data['email'] ?? '');

        try {
            $this->entityManager->persist($contact);
            $this->entityManager->flush();

            $this->mailer->sendEmail(
                'diamante_7%40hotmail.fr',
                'Nouvelle demande de contact',
                sprintf(
                    "Nouvelle demande reçue :\n\nTitre : %s\nEmail : %s\nMessage :\n%s",
                    $contact->getTitle(),
                    $contact->getEmail(),
                    $contact->getDescription()
                )
            );

            return new JsonResponse(['message' => 'Demande envoyée avec succès.'], 201);
        } catch (\Throwable $e) {
            return new JsonResponse(['message' => 'Erreur serveur.'], 500);
        }
    }

    #[Route('/api/contact/requests', name: 'api_contact_list', methods: ['GET'])]

    public function list(): JsonResponse
    {
        $contacts = $this->entityManager
            ->getRepository(ContactRequest::class)
            ->findAll();

        $data = array_map(function (ContactRequest $c) {
            return [
                'id' => $c->getId(),
                'title' => $c->getTitle(),
                'email' => $c->getEmail(),
                'description' => $c->getDescription(),
            ];
        }, $contacts);

        return new JsonResponse($data);
    }

    #[Route('/api/contact/reply', name: 'api_contact_reply', methods: ['POST'])]

    public function reply(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['email']) || empty($data['message'])) {
            return new JsonResponse(['message' => 'Email et message requis.'], 400);
        }

        try {
            $this->mailer->sendEmail(
                $data['email'],
                'Réponse à votre demande de contact',
                $data['message']
            );

            return new JsonResponse(['message' => 'Réponse envoyée.']);
        } catch (\Throwable $e) {
            return new JsonResponse(['message' => 'Erreur lors de l\'envoi.'], 500);
        }
    }


    #[Route('/api/contact/requests/{id}', name: 'delete_contact_request', methods: ['DELETE'])]
public function deleteContactRequest(ContactRequestRepository $repo, int $id, EntityManagerInterface $em): JsonResponse
{
    $contact = $repo->find($id);
    if (!$contact) {
        return $this->json(['message' => 'Contact non trouvé'], 404);
    }
    $em->remove($contact);
    $em->flush();
    return $this->json(['message' => 'Contact supprimé!']);
}
}
