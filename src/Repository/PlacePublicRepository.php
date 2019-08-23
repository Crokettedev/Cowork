<?php

namespace App\Repository;

use App\Entity\PlacePublic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PlacePublic|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlacePublic|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlacePublic[]    findAll()
 * @method PlacePublic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlacePublicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PlacePublic::class);
    }

    /**
    * @return PlacePublic[] Returns an array of PlacePublic objects
    */


    public function findById()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?PlacePublic
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
