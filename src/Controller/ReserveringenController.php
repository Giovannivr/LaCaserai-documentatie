<?php

namespace App\Controller;


use App\Entity\Reservering;
use App\Entity\Kamer;
use App\Form\ReserveringType;
use App\Repository\ReserveringRepository;
use App\Repository\KamerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;




class ReserveringenController extends AbstractController

{




    /**
     * @Route("/reserveringen", name="reserveringen")
     */
    public function allereserveringen(ReserveringRepository $reserveringRepository): Response
    {

             return $this->render('reserveringen/index.html.twig', [
               'reserverings' => $reserveringRepository->findAll(),
             ]);
    }

    /**
     * @Route("/reserveringeninput", name="reserveringeninput")
     */
    public function reserveringeninput(ReserveringRepository $reserveringRepository): Response
    {

        return $this->render('reserveringen/input.html.twig', [
            'reserverings' => $reserveringRepository->findAll(),
        ]);
    }

    /**
     * @Route("/reserveringenvrij", name="reserveringenvrij")
    */
    public function vrijekamers(ReserveringRepository $reserveringRepository): Response
    {
        $value = ['checkin' => '2019-05-24', 'checkout' => '2019-06-13'];
        $reserveringen = $reserveringRepository->findvrijekamers($value);

        $em = $this->getDoctrine()->getManager();
        $kamers = $em->getRepository('App:Kamer')->findAll();

        dump($kamers);

        $reskamer = [];

        // nu bevat kamers alle kamers van het hotel en reserveringen de kamers die bezet zijn in de gekozen periode
        // probeer nu de gereserveerde kamers in array reskamer te zetten zodat later die kamers niet verschijnen
        foreach ($reserveringen as $reservering) {
            // per reservering een array vullen met gereserveerde kamernummer.
            dump($reservering);
            foreach ($reservering->getKamerid() as $xkamerid) {
              //  array_push($reskamer, $xkamerid->getId());
                dump($xkamerid);

            }
        }


        return $this->render('reserveringen/reserveringenvrij.html.twig', [
            'reserverings' => $reserveringen
        ]);

    }



}











