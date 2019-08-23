<?php

namespace App\Repository;

use App\Entity\SupplyFood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SupplyFood|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupplyFood|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupplyFood[]    findAll()
 * @method SupplyFood[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplyFoodRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SupplyFood::class);
    }

    /**
    * @return SupplyFood[] Returns an array of SupplyFood objects
    */

    public function findByLabel1()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.label = 1')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByLabel2()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.label = 2')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByLabel3()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.label = 3')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByLabel4()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.label = 4')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByLabel5()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.label = 5')
            ->getQuery()
            ->getResult()
            ;
    }
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
    public function findOneBySomeField($value): ?SupplyFood
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
