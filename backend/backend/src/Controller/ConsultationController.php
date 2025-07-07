<?php

namespace App\Controller;

use App\Document\Consultation;
use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ConsultationController extends AbstractController
{
    private DocumentManager $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    
#[Route('/api/consultations', name: 'increment_consultation', methods: ['POST'])]
public function incrementConsultation(Request $request, DocumentManager $dm): JsonResponse
{
    $data = json_decode($request->getContent(), true);
    $animalId = $data['animalId'] ?? null;
    if (!$animalId) {
        return $this->json(['error' => 'animalId missing'], 400);
    }

    $repo = $dm->getRepository(Consultation::class);
    $consultation = $repo->findOneBy(['animalId' => $animalId]);
    if (!$consultation) {
        $consultation = new Consultation();
        $consultation->setAnimalId($animalId);
        $consultation->setCount(1);
        $dm->persist($consultation);
    } else {
        $consultation->setCount($consultation->getCount() + 1);
    }
    $dm->flush();

    return $this->json([
        'animalId' => $animalId,
        'count' => $consultation->getCount()
    ]);
}


#[Route('/api/consultations', name: 'get_consultations', methods: ['GET'])]
public function getConsultations(DocumentManager $dm, EntityManagerInterface $em): JsonResponse
{
    $consultations = $dm->getRepository(\App\Document\Consultation::class)->findAll();
    $result = [];

    foreach ($consultations as $consultation) {
        $animalId = $consultation->getAnimalId();
        $animalName = null;

        
        if ($animalId !== null) {
            try {
                $animal = $em->getRepository(\App\Entity\Animal::class)->find($animalId);
                if ($animal) {
                    $animalName = $animal->getPrenom();
                }
            } catch (\Exception $e) {
                // Fehler abfangen, animalName bleibt null
               
            }
        }

        $result[] = [
            'animalId'   => $animalId,
            'animalName' => $animalName,
            'count'      => $consultation->getCount(),
        ];
    }

    
    return $this->json($result);
}

}