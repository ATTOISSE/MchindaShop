<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Repository\OrderDetailsRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commande', name: 'order_')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
                          OrderRepository $order,
                          OrderDetailsRepository $orderDetail
                          ){
        return $this->render('order/index.html.twig', [
            'orderDetail' => $orderDetail->findOneBy([], ['id' => 'desc']),
            'order' => $order->findOneBy([], ['id' => 'desc'])
        ]);
    }
    
    #[Route('/ajout', name: 'add')]
    public function add(
        Security $security,
        SessionInterface $session,
        EntityManagerInterface $em,
        OrderRepository $orderRepository,
        ProductRepository $productRepository,
        OrderDetailsRepository $orderDetailsRepository
        ): Response
    {
        if (!$security->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        $panier = $session->get('panier',[]);
        if ($panier === []) {
            $this->addFlash('message','votre panier est vide');
            return $this->redirectToRoute('home');
        }

        $order = new Order();
        $order->setUsers($this->getUser());
        $order->setReference(uniqid());
        $order->setNumber(uniqid());
        $order->setStatus('paye');

        $amount_total = 0;
        
        foreach ($panier as $item => $quantity) {
            $orderDetail = new OrderDetails();
            $product = $productRepository->find($item);
            $price = $product->getPrice();
            $amount_total += $price * $quantity;
            $orderDetail->setProducts($product);
            $orderDetail->setQuantity($quantity);
            $orderDetail->setPrice($price);
            
            $order->addOrderDetail($orderDetail);
        }
        
        $order->setAmountTotal($amount_total);

        $em->persist($order);
        $em->flush();
        
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'order' => $orderRepository->findOneBy([], ['id' => 'desc']),
            'orderDetail' => $orderDetailsRepository->findOneBy([], ['id' => 'desc'])
        ]);
    }
}