<?php

namespace App\Repository;

use App\Entity\SupplyOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SupplyOffice|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupplyOffice|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupplyOffice[]    findAll()
 * @method SupplyOffice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplyOfficeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SupplyOffice::class);
    }

    // /**
    //  * @return SupplyOffice[] Returns an array of SupplyOffice objects
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
    public function findOneBySomeField($value): ?SupplyOffice
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
