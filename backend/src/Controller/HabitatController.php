<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/habitats')]
class HabitatController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer,
        private SluggerInterface $slugger
    ) {}

    #[Route('', name: 'get_habitats', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $habitats = $this->entityManager->getRepository(Habitat::class)->findAll();
        return $this->json($habitats, Response::HTTP_OK, [], ['groups' => 'habitat:read']);
    }

    #[Route('', name: 'create_habitat', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $habitat = new Habitat();
        $habitat->setNom($request->get('nom'));
        $habitat->setDescription($request->get('description'));

        /** @var UploadedFile[] $images */
        $images = $request->files->all()['images'] ?? [];

        foreach ($images as $imageFile) {
            $newFilename = uniqid() . '.' . $imageFile->guessExtension();

            try {
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                return $this->json(['message' => 'Erreur upload image'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $image = new Image();
            $image->setUrl('/uploads/images/' . $newFilename);
            $image->setAlt($habitat->getNom());
            $habitat->addImage($image);
            $this->entityManager->persist($image);
        }

        $this->entityManager->persist($habitat);
        $this->entityManager->flush();

        return $this->json($habitat, Response::HTTP_CREATED, [], ['groups' => 'habitat:read']);
    }

    #[Route('/{id}', name: 'update_habitat', methods: ['PUT', 'POST'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $habitat = $this->entityManager->getRepository(Habitat::class)->find($id);

        if (!$habitat) {
            return $this->json(['message' => 'Habitat non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $nom = $request->get('nom');
        $description = $request->get('description');

        if (!empty($nom)) {
            $habitat->setNom($nom);
        }

        if (!empty($description)) {
            $habitat->setDescription($description);
        }

        /** @var UploadedFile[] $images */
        $images = $request->files->all()['images'] ?? [];

        if (!empty($images)) {
            // Alte bilder löschen
            foreach ($habitat->getImages() as $image) {
                $habitat->removeImage($image);
                $this->entityManager->remove($image);
            }

            // Neue bilder hinzufügen
            foreach ($images as $imageFile) {
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move($this->getParameter('images_directory'), $newFilename);
                } catch (FileException $e) {
                    return $this->json(['message' => 'Erreur upload image'], Response::HTTP_INTERNAL_SERVER_ERROR);
                }

                $image = new Image();
                $image->setUrl('/uploads/images/' . $newFilename);
                $image->setAlt($habitat->getNom());
                $habitat->addImage($image);
                $this->entityManager->persist($image);
            }
        }

        $this->entityManager->flush();

        return $this->json($habitat, Response::HTTP_OK, [], ['groups' => 'habitat:read']);
    }

    #[Route('/{id}', name: 'delete_habitat', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $habitat = $this->entityManager->getRepository(Habitat::class)->find($id);

        if (!$habitat) {
            return $this->json(['message' => 'Habitat non trouvé'], Response::HTTP_NOT_FOUND);
        }

        foreach ($habitat->getImages() as $image) {
            $habitat->removeImage($image);
            $this->entityManager->remove($image);
        }

        $this->entityManager->remove($habitat);
        $this->entityManager->flush();

        return $this->json(['message' => 'Habitat supprimé avec succès'], Response::HTTP_OK);
    }
}

    


