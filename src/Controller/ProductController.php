<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Item;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    public function items()
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $item = new Item();
        $item->setDescription('Ergonomic and stylish!');

        // relates this product to the category
        $item->setCategory($category);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->persist($item);
        $entityManager->flush();

//        $category = $this->getDoctrine()
//            ->getRepository(Category::class)
//            ->find(1);
//
//        $products = $category->getProducts();


        return new Response(
            'Saved new product with id: '.$item->getId()
            .' and new category with id: '.$category->getId()
            .' and new category name is:'.$item->getCategory()->getName()
        );
    }

    /**
     * @return Response
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);

        return $this->render('products/index.html.twig', [
            'products' => $repository->findAll(),
        ]);
    }

    /**
     * @param $productId
     * @return Response
     */
    public function store($productId)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        if (!$productId) {
            $product = new Product();
            $product->setName('Keyboard');
            $product->setPrice(19.99);
            $product->setDescription('Ergonomic and stylish!');

            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($product);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
        } else {
            return $this->show($productId);
        }

        return $this->render('products/edit.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @param $productId
     * @return Response
     */
    public function show($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        return $this->render('products/edit.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @param $productId
     */
    public function destroy($productId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        $entityManager->remove($product);
        $entityManager->flush();
    }
}
