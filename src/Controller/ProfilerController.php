<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil', name: 'profiler_')]
class ProfilerController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('profiler/index.html.twig', [
            'controller_name' => 'ProfilerController',
        ]);
    }

    #[Route('/commande', name: 'orders')]
    public function orders(): Response
    {
        return $this->render('profiler/index.html.twig', [
            'controller_name' => 'commande de l\'utilisateur',
        ]);
    }
}