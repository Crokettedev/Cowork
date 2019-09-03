<?php

namespace App\Repository;

use App\Entity\SpacePrivate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SpacePrivate|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpacePrivate|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpacePrivate[]    findAll()
 * @method SpacePrivate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpacePrivateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SpacePrivate::class);
    }

    // /**
    //  * @return SpacePrivate[] Returns an array of SpacePrivate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpacePrivate
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
