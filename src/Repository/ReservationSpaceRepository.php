<?php

namespace App\Repository;

use App\Entity\ReservationSpace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReservationSpace|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationSpace|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationSpace[]    findAll()
 * @method ReservationSpace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationSpaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationSpace::class);
    }

    // /**
    //  * @return ReservationSpace[] Returns an array of ReservationSpace objects
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
    public function findOneBySomeField($value): ?ReservationSpace
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
