<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepageAction(Request $request)
    {
        // replace this example code with whatever you need
        $response = $this->render('default/index.html.twig', [
            'base_dir' => $request->query->get('name'),
        ]);

        return $response;
    }

    /**
     * @Route("/hello/{name}", defaults={"name"="world"}, requirements={"name"="[a-zA-Z]+"})
     */
    public function helloWorldAction($name)
    {

        return new Response('Hello '.$name.'!');
    }
}
