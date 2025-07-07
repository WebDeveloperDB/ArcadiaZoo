<?php

namespace App\Controller;

use App\Entity\Image;
use APP\Repository\ImageRepository;
use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Psr\Log\LoggerInterface;



#[Route('/api/services')]
class ServiceController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer,
        private SluggerInterface $slugger
    ) {}

    #[Route('', name: 'get_services', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $services = $this->entityManager->getRepository(Service::class)->findAll();

        return $this->json($services, Response::HTTP_OK, [], ['groups' => 'service:read']);
    }

    #[Route('', name: 'create_service', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        // empêche de créer deux services avec le même nom
        $existingService = $this->entityManager->getRepository(Service::class)->findOneBy(['nom' => $request->get('nom')]);
        if ($existingService) {
            return $this->json(['message' => 'Ce nom de service existe déjà.'], Response::HTTP_CONFLICT);
        }

        $service = new Service();
        $service->setNom($request->get('nom'));
        $service->setDescription($request->get('description'));

        /** @var UploadedFile[] $images */
        $images = $request->files->all()['images'] ?? [];

        foreach ($images as $imageFile) {
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            try {
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                return $this->json(['message' => 'Erreur lors de l\'upload de l\'image.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $image = new Image();
            $image->setUrl('/uploads/images/' . $newFilename);
            $image->setAlt($request->get('nom'));

            $this->entityManager->persist($image);
            $service->addImage($image);
        }

        $this->entityManager->persist($service);
        $this->entityManager->flush();

        return $this->json($service, Response::HTTP_CREATED, [], ['groups' => 'service:read']);
    }


  #[Route('/{id}', name: 'update_service', methods: ['PUT', 'POST'])] 
public function update(Request $request, int $id): JsonResponse
{
    $service = $this->entityManager->getRepository(Service::class)->find($id);

    if (!$service) {
        return $this->json(['message' => 'Service non trouvé.'], Response::HTTP_NOT_FOUND);
    }

    $nom = $request->get('nom');
    if (!empty($nom)) {
        $service->setNom($nom);
    }

    $description = $request->get('description');
    if (!empty($description)) {
        $service->setDescription($description);
    }

    /** @var UploadedFile[] $images */
    $images = $request->files->all()['images'] ?? [];

    if (!empty($images)) {
        // Alte bilder löschen
        foreach ($service->getImages() as $image) {
            $service->removeImage($image);
            $this->entityManager->remove($image);
        }

        // Neue bilder hinzufügen
        foreach ($images as $imageFile) {
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            try {
                $imageFile->move($this->getParameter('images_directory'), $newFilename);
            } catch (FileException $e) {
                return $this->json(['message' => 'Erreur lors de l\'upload de l\'image.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $image = new \App\Entity\Image();
            $image->setUrl('/uploads/images/' . $newFilename);
            $image->setAlt($service->getNom() ?? 'image');

            $this->entityManager->persist($image);
            $service->addImage($image);
        }
    }

    $this->entityManager->flush();

    return $this->json($service, Response::HTTP_OK, [], ['groups' => 'service:read']);
}




    

    #[Route('/{id}', name: 'delete_service', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $service = $this->entityManager->getRepository(Service::class)->find($id);

        if (!$service) {
            return $this->json(['message' => 'Service non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($service->getImages() as $image) {
            $service->removeImage($image);
            $this->entityManager->remove($image);
        }

        $this->entityManager->remove($service);
        $this->entityManager->flush();

        return $this->json(['message' => 'Service supprimé avec succès.'], Response::HTTP_OK);
    }
}




