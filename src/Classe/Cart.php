<?php

namespace App\Classe;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{
    private $stack;
    private $entityManager;

    public function __construct(RequestStack $stack, EntityManagerInterface $entitymanager)
    {
        $this->stack = $stack;
        $this->entityManager = $entitymanager;
    }

    public function add($id)
    {
        $session = $this->stack->getSession();
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);
    }

    public function get()
    {
        $methodget = $this->stack->getSession();
        return $methodget->get('cart');
    }

    public function remove()
    {
        $methodremove = $this->stack->getSession();
        $methodremove->remove('cart');
    }

    public function delete($id)
    {
        $session = $this->stack->getSession();
        $cart = $session->get('cart', []);

        unset($cart[$id]);
        return $session->set('cart', $cart);
    }

    public function decrease($id)
    {
        $session = $this->stack->getSession();
        $cart = $session->get('cart', []);

        //Véfifier si la quantité de notre produit = 1
        if ($cart[$id] > 1) {
            //Retirer une quantité
            $cart[$id]--;
        } else {
            //supprimer mon produit
            unset($cart[$id]);
        }
        return $session->set('cart', $cart);
    }

    public function getFull()
    {
        $cartComplete = [];
        if ($this->get()) {
            foreach ($this->get() as $id => $quantity) {
                $productObject = $this->entityManager->getRepository(Product::class)->findOneById($id);

                if (!$productObject) {
                    $this->delete($id);
                    continue;
                } else {
                    $cartComplete[] = [
                        'product' => $productObject,
                        'quantity' => $quantity,
                    ];
                }
            }
        }
        return $cartComplete;
    }
}
