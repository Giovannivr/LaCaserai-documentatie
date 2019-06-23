<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdministratieController extends AbstractController
{
    /**
     * @Route("/administratie", name="administratie")
     */
    public function index()
    {
        return $this->render('administratie/index.html.twig', [
            'controller_name' => 'AdministratieController',
        ]);
    }
}
