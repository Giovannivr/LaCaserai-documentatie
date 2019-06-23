<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KamersController extends AbstractController
{
    /**
     * @Route("/kamers", name="kamers")
     */
    public function index()
    {
        return $this->render('kamers/index.html.twig', [
            'controller_name' => 'KamersController',
        ]);
    }
}
