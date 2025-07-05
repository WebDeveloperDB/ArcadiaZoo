<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Habitat;
use App\Repository\HabitatRepository;
use App\Entity\Image;
use App\Entity\Race;
use App\Entity\RapportVeterinaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/animals')]
class AnimalController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SluggerInterface $slugger,
        private SerializerInterface $serializer
    ) {}

    #[Route('/{id}', name: 'get_animals', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $animals = $this->entityManager->getRepository(Animal::class)->findAll();

        return $this->json($animals, Response::HTTP_OK, [], ['groups' => 'animal:read']);
    }

    #[Route('', name: 'create_animal', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $animal = new Animal();

        $nom = $request->get('prenom');
        $description = $request->get('description');
        $habitatId = $request->get('habitat_id');

        if (!$nom || !$description || !$habitatId) {
            return $this->json(['message' => 'Champs manquants.'], Response::HTTP_BAD_REQUEST);
        }

        $habitat = $this->entityManager->getRepository(Habitat::class)->find($habitatId);
        if (!$habitat) {
            return $this->json(['message' => 'Habitat non trouvé.'], Response::HTTP_NOT_FOUND);
        }

       

        $animal->setPrenom($nom);
        $animal->setDescription($description);
        $animal->setHabitat($habitat);

        $imageFile = $request->files->get('image');
        if ($imageFile) {
            $newFilename = uniqid().'.'.$imageFile->guessExtension();
            try {
                $imageFile->move($this->getParameter('images_directory'), $newFilename);
                $image = new Image();
                $image->setUrl('/uploads/images/' . $newFilename);
                $image->setAlt($nom);
                $this->entityManager->persist($image);
                $animal->addImage($image);
            } catch (FileException $e) {
                return $this->json(['message' => 'Erreur lors de l\'upload de l\'image.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

 
      //  $rapport->setDate(new \DateTimeImmutable());
       

        $this->entityManager->persist($animal);
        $this->entityManager->flush();

        return $this->json($animal, Response::HTTP_CREATED, [], ['groups' => 'animal:read']);
    }

    #[Route('/{id}', name: 'update_animal', methods: ['POST', 'PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $animal = $this->entityManager->getRepository(Animal::class)->find($id);
        if (!$animal) {
            return $this->json(['message' => 'Animal non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        if ($request->get('prenom')) {
            $animal->setPrenom($request->get('prenom'));
        }

        if ($request->get('description')) {
            $animal->setDescription($request->get('description'));
        }

       

        $imageFile = $request->files->get('image');
        if ($imageFile) {
            $newFilename = uniqid().'.'.$imageFile->guessExtension();
            try {
                $imageFile->move($this->getParameter('images_directory'), $newFilename);
                $image = new Image();
                $image->setUrl('/uploads/images/' . $newFilename);
                $image->setAlt($animal->getPrenom());
                $this->entityManager->persist($image);
                $animal->addImage($image);
            } catch (FileException $e) {
                return $this->json(['message' => 'Erreur image.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        $this->entityManager->flush();

        return $this->json($animal, Response::HTTP_OK, [], ['groups' => 'animal:read']);
    }

    #[Route('/{id}', name: 'delete_animal', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $animal = $this->entityManager->getRepository(Animal::class)->find($id);
        if (!$animal) {
            return $this->json(['message' => 'Animal non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($animal->getImages() as $image) {
            $animal->removeImage($image);
            $this->entityManager->remove($image);
        }



        $this->entityManager->remove($animal);
        $this->entityManager->flush();

        return $this->json(['message' => 'Animal supprimé.'], Response::HTTP_OK);
    }
}





