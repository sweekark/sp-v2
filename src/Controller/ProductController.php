<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Category1;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }



    /**
     * @Route("/create_product_cat", name="createProductWithCat")
     */
    public function createProductWithCat()
    { 
        $category = new Category();
        $category->setName('Computer Peripherals');
        
        $category1 = new Category1();
        $category1->setName('Computer Peripherals');
        
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // relates this product to the category
        $product->setCategory($category);
        $product->setCategory1($category1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->persist($category1);
        $entityManager->persist($product);
        $entityManager->flush();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }
    /**
     * @Route("/create_product", name="create_product")
     */
    public function createProduct(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
 * @Route("/product/{id}", name="product_show")
 */
public function show($id)
{
    $product = $this->getDoctrine()
    ->getRepository(Product::class)
    ->find($id);

// ...

    // $categoryName = $product->getCategory()->getName();

    // $product = $this->getDoctrine()
    //     ->getRepository(Product::class)
    //     ->find($id);

    if (!$product) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }

    return new Response('Check out this great product: '.$product->getName());

    // or render a template
    // in the template, print things with {{ product.name }}
    // return $this->render('product/show.html.twig', ['product' => $product]);
}


/**
 * @Route("/products/", name="product_show_all")
 */
public function products()
{
    $minPrice = 1;

    $products = $this->getDoctrine()
    ->getRepository(Product::class)
    ->findAllGreaterThanPrice($minPrice);

    // return new Response('Check out this great product: '.$products);

    // or render a template
    // in the template, print things with {{ product.name }}
    return $this->render('product/show.html.twig', ['products' => $products,'controller_name'=> 'productController']);
}

}