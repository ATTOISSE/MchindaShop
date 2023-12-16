<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProductRepository $product): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController', 
            'products' => $product->findAll(),
        ]);
    }
}