<?php

namespace App\Repository;

use App\Entity\SpacePublic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SpacePublic|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpacePublic|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpacePublic[]    findAll()
 * @method SpacePublic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpacePublicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SpacePublic::class);
    }

    // /**
    //  * @return SpacePublic[] Returns an array of SpacePublic objects
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
    public function findOneBySomeField($value): ?SpacePublic
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
