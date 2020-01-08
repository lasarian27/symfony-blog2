<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $number = random_int(0, 100);

        return $this->render('home.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/about", name="aboutpage")
     */
    public function about()
    {
        return new Response(
            '<html><body>About page!!</body></html>'
        );
    }
}
