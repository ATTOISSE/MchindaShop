<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PictureRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        ProductRepository $product,
        CategoryRepository $category,
        PictureRepository $picture
    ): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $product->findAll(), 
            'categories' => $category->findAll(), 
            'pictures' => $picture->findAll(), 
        ]);
    }
}