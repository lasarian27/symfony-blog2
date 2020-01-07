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
        return new Response(
            '<html><body>Hello world!!</body></html>'
        );
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
