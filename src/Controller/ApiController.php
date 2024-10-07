<?php

namespace App\Controller;

use App\Entity\Info;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @Route("/api", name="api_")
 */
final class ApiController extends AbstractController
{
    #[Route('/api/versicherungsmakler', name: 'api_versicherungsmakler', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): Response
    {
        $infos = $doctrine
            ->getRepository(Info::class)
            ->findAll();

        $data = [];
        foreach ($infos as $info) {
            $data[] = [
                'id'          => $info->getId(),
                'name'        => $info->getName(),
                'description' => $info->getDescription()
            ];
        }

        return $this->json($data);
    }

    #[Route('/api/versicherungsmakler', name: 'add_versicherungsmakler', methods: ['POST'])]
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $info = new Info();
        $info->setName($request->request->get('name'));
        $info->setDescription($request->request->get('description'));
        $entityManager->persist($info);
        $entityManager->flush();

        return $this->json('Add new makler with id: ' . $info->getId());
    }

    #[Route('/api/versicherungsmakler/{id}', name: 'show_versicherungsmakler', methods: ['GET'])]
    public function view(ManagerRegistry $doctrine, int $id): Response
    {
        $info = $doctrine->getRepository(Info::class)->find($id);
        if (!$info) {
            return $this->json('No result for id' . $id, 404);
        }

        $data = [
            'id'          => $info->getId(),
            'name'        => $info->getName(),
            'description' => $info->getDescription()
        ];

        return $this->json($data);
    }

    #[Route('/api/versicherungsmakler/{id}', name: 'update_versicherungsmakler', methods: ["PUT", "PATCH"])]
    public function update(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $info = $entityManager->getRepository(Info::class)->find($id);
        if (!$info) {
            return $this->json('No result for id' . $id, 404);
        }


        $info->setName($request->request->get('name'));
        $info->setDescription($request->request->get('description'));

        $entityManager->flush();

        $data = [
            'id'          => $info->getId(),
            'name'        => $info->getName(),
            'description' => $info->getDescription()
        ];

        return $this->json($data);
    }

    #[Route('/api/versicherungsmakler/{id}', name: 'delete_versicherungsmakler', methods: ["DELETE"])]
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $info = $entityManager->getRepository(Info::class)->find($id);

        if (!$info) {
            return $this->json('No Employee found for id' . $id, 404);
        }
        $entityManager->remove($info);
        $entityManager->flush();

        return $this->json('Deleted successfully with id ' . $id);
    }
}
