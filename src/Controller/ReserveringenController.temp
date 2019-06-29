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

        dump ($kamers);
        $reskamers =[];
        foreach ($reserveringen as $reservering) {
            dump($reservering);
            array_push($reskamers, $reservering->getKamerid()->getId());
            dump($reskamers);
        }


        foreach ($kamers as $key => $kamer) {
            foreach ($reskamers as $reskam) {
                if ($kamer->getId() == $reskam) {
                    // verwijder de bezette kamers.
                    unset($kamers[$key]);
                }
            }
        }

        dump($kamers);

        return $this->render('reserveringen/reserveringenvrij.html.twig', [
            'kamers' => $kamers
        ]);

    }




}











