<?php

namespace App\Repository;

use App\Entity\MessageJob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MessageJob|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessageJob|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessageJob[]    findAll()
 * @method MessageJob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageJobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MessageJob::class);
    }

    // /**
    //  * @return MessageJob[] Returns an array of MessageJob objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MessageJob
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
