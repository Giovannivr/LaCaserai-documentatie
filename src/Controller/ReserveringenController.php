<?php

namespace App\Controller;


use App\Entity\Reservering;
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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Forms;



class ReserveringenController extends AbstractController

{

    /**
     * @Route("/reserveringen", name="reserveringen")
     */
  /*  public function allereserveringen(ReserveringRepository $reserveringRepository): Response
    {

        return $this->render('reserveringen/index.html.twig', [
            'reserverings' => $reserveringRepository->findAll(),
        ]);
    }*/

    /**
     * @Route("/reserveringeninput", name="reserveringeninput")
     */
   /* public function nieuwedatums(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('checkin', DateType::class)
            ->add('checkuit', DateType::class)
            ->getForm();

        // start een eventhandler voor het form
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // haal data uit het form op
            $datums = $form->getData();
            // zet de checkin en checkuitdatum in het juiste formaat
            $checkindatum = ($datums['checkin'])->format('Y-m-d');
            $checkuitdatum = ($datums['checkuit'])->format('Y-m-d');


            echo $checkindatum;
            echo $checkuitdatum;

            //     $reserveerdatums = ['checkin' => '2019-05-24', 'checkout' => '2019-06-13'];

            return $this->redirectToRoute('reserveringenvrij', ['checkind' => '2019-05-24', 'checkoutd' => '2019-06-13']);



        }

        return $this->render('reserveringen/input2.html.twig', [
            'form' => $form->createView(),
        ]);

    }*/


    /**
     * @Route("/reserveringenvrij", name="reserveringenvrij")
     */
    public function vrijekamers(Request $request)
    {


        $form = $this->createFormBuilder()
            ->add('checkin', DateType::class,  [
                'data' => new \DateTime("now")
            ])
            ->add('checkuit', DateType::class,  [
                'data' => new \DateTime("now")
            ])
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // haal data uit het form op
            $datums = $form->getData();
            $checkindatum = ($datums['checkin'])->format('Y-m-d');
            $checkuitdatum = ($datums['checkuit'])->format('Y-m-d');

            echo $checkindatum;
            echo $checkuitdatum;


            $em = $this->getDoctrine()->getManager();
            $value = ['checkin' => $checkindatum, 'checkout' => $checkuitdatum];
            $reserveringen = $em->getRepository('App:Reservering')->findvrijekamers($value);
            dump ($value);
            //     $reserveerdatums = ['checkin' => '2019-05-24', 'checkout' => '2019-06-13'];

            $kamers = $em->getRepository('App:Kamer')->findAll();

            dump ($kamers);
            $reskamers =[];
            foreach ($reserveringen as $reservering) {
                dump($kamers);
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

            //          return $this->redirectToRoute('reserveringenvrij');

        }


        return $this->render('reserveringen/input2.html.twig', [
            'form' => $form->createView(),
        ]);





    }

    /**
     * @Route("/reserveringenvrij2", name="reserveringenvrij2")
     */
    public function vrijekamers2(KamerRepository $kamerRepository): Response
    {
        $value = ['checkin' => '2019-05-24', 'checkout' => '2019-06-13'];
        $reserveringen = $kamerRepository->findvrijekamers2($value);




        return $this->render('reserveringen/reserveringenvrij2.html.twig', [
            'reserverings' => $reserveringen
        ]);

    }



}











