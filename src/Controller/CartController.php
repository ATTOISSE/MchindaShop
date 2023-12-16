<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier', name: 'panier_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $panier = $session->get('panier', []);
        $data = [];
        $total = 0;
        foreach ($panier as $id => $quantity) {
            $product = $productRepository->find($id);
            $data[] = [
                'product' => $product,
                'quantity' => $quantity
            ];
            $total += $quantity * $product->getPrice();
        }
        return $this->render('cart/index.html.twig', [
            'data' => $data,
            'total' => $total
        ]);
    }

    #[Route('/ajouter/{id}', name: 'add')]
    public function add(SessionInterface $session, Product $product): Response
    {
        $id = $product->getId();
        $panier = $session->get('panier', []);
        if (empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute('panier_index');
    }

    #[Route('/retirer/{id}', name: 'remove')]
    public function remove(SessionInterface $session, Product $product): Response
    {
        $id = $product->getId();
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute('panier_index');
    }

    #[Route('/suppimer/{id}', name: 'delete')]
    public function delete(SessionInterface $session, Product $product): Response
    {
        $id = $product->getId();
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute('panier_index');
    }
    
    #[Route('/vider', name: 'empty')]
    public function empty(SessionInterface $session): Response
    {
        $session->remove('panier');
        return $this->redirectToRoute('panier_index');
    }
}