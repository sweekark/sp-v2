<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Entity\Category;

class PersonController extends AbstractController
{
    /**
     * @Route("/person", name="person")
     */
    public function index()
    {
        return $this->render('person/index.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }


    /**
     * @Route("/create_person_cat", name="createPersonWithCat")
     */
    public function createPersonWithCat()
    { 
        $category = new Category();
        $category->setName('Computer Peripherals');
        
        $product = new Person();
        $product->setName('Keyboard');
        $product->setCategory($category);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->persist($product);
        $entityManager->flush();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }
}
