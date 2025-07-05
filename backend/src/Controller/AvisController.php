<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


#[Route('/api/avis')]
class AvisController extends AbstractController
{
    #[Route('', name: 'create_avis', methods: ['POST'])]
    public function createAvis(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (
            !isset($data['pseudo']) || empty(trim($data['pseudo'])) ||
            !isset($data['commentaire']) || empty(trim($data['commentaire']))
        ) {
            return $this->json(['message' => 'Champs manquants.'], 400);
        }

        $avis = new Avis();
        $avis->setPseudo($data['pseudo']);
        $avis->setCommentaire($data['commentaire']);
        $avis->setIsValidated(false);
        $avis->setCreatedAt(new \DateTimeImmutable());

        $em->persist($avis);
        $em->flush();

        return $this->json(['message' => 'Avis soumis avec succès. Il sera publié après validation par un employé.']);
    }

    #[Route('/validated', name: 'get_validated_avis', methods: ['GET'])]
    public function getValidatedAvis(AvisRepository $repo): JsonResponse
    {
        $avis = $repo->findBy(['isValidated' => true], ['createdAt' => 'DESC']);

        return $this->json(array_map(fn($a) => [
            'id' => $a->getId(),
            'pseudo' => $a->getPseudo(),
            'commentaire' => $a->getCommentaire(),
            'createdAt' => $a->getCreatedAt()?->format('Y-m-d H:i:s'),
        ], $avis));
    }

    #[Route('/pending', name: 'get_pending_avis', methods: ['GET'])]
    public function getPendingAvis(AvisRepository $repo): JsonResponse
    {
        $avis = $repo->findBy(['isValidated' => false], ['createdAt' => 'ASC']);

        return $this->json(array_map(fn($a) => [
            'id' => $a->getId(),
            'pseudo' => $a->getPseudo(),
            'commentaire' => $a->getCommentaire(),
            'createdAt' => $a->getCreatedAt()?->format('Y-m-d H:i:s'),
        ], $avis));
    }

    #[Route('/{id}/validate', name: 'validate_avis', methods: ['POST'])]
    public function validateAvis(Avis $avis, EntityManagerInterface $em): JsonResponse
    {
        if ($avis->isValidated()) {
            return $this->json(['message' => 'Avis bereits validiert.'], 400);
        }
        $avis->setIsValidated(true);
        $em->flush();

        return $this->json(['message' => 'Avis validiert.']);
    }

    #[Route('/{id}', name: 'delete_avis', methods: ['DELETE'])]
    public function deleteAvis(Avis $avis, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($avis);
        $em->flush();

        return $this->json(['message' => 'Avis supprimé.']);
    }
}


