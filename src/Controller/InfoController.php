<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/info')]
final class InfoController extends AbstractController
{
    #[Route(name: 'app_info_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('info/index.html.twig');
    }
}
