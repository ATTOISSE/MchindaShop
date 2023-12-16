<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\PictureRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit', name: 'product_')]

class ProductController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProductRepository $products): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products->paginate(1, 16)

        ]);
    }

    #[Route('/{wording}', name: 'details')]
    public function details(Product $product): Response
    {
        return $this->render('product/detail.html.twig', [
            'controller_name' => 'detail du produit',
            'product' => $product
        ]);
    }
}