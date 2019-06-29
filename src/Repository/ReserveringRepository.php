<?php

namespace App\Repository;

use App\Entity\Reservering;
use App\Entity\Kamer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reservering|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservering|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservering[]    findAll()
 * @method Reservering[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReserveringRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reservering::class);
    }


    /**
    * @return Reserveringen[] Returns an array of Reservation objects
    * $value = array meegegeven uit aanroep functie met checkin en checkout datum
    */
    public function findvrijekamers($value)
    {

        $qb = $this->createQueryBuilder('r')
            ->andWhere('r.checkinDate <= :checkout')
            ->andWhere('r.checkoutDate >= :checkin')
            ->setParameter('checkin', $value['checkin'])
            ->setParameter('checkout', $value['checkout'])
            ->orderBy('r.kamerid', 'ASC')
        ;

        dump ($qb->getQuery()->getResult()) ;

        return $qb->getQuery()->getResult();
    }



    #deze werkte
    #$kamernummers = 8;
#$qb = $this->createQueryBuilder('r')
#->where('r.kamerid =:kamerpid')
#->setParameter('kamerpid', $kamernummers )



    # van Henryu Robben gehad
#   /**
#    * @return Reservation[] Returns an array of Reservation objects
#    * $value = ['checkin' => '17-06-2019', 'checkout' => '24-05-2019']
#    */
#    public function findRoomsReserved($value)
#{
#    dump($value);
#    halt();
#    return $this->createQueryBuilder('r')
#        ->andWhere('r.exampleField = :val')
#        ->setParameter('checkin', $value['checkin'])
#        ->setParameter('checkout', $value['checkout'])
#        //->orderBy('r.id', 'ASC')
#        //->setMaxResults(10)
#        ->getQuery()
#        ->getResult()
#        ;
#}

    // /**
    //  * @return Reservering[] Returns an array of Reservering objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reservering
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
