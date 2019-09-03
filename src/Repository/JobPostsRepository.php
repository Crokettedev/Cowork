<?php
namespace App\Repository;
use App\Entity\JobPosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * @method JobPosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobPosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobPosts[]    findAll()
 * @method JobPosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobPostsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JobPosts::class);
    }
    /**
     * @return JobPosts[] Returns an array of JobPosts objects
    */
    public function findAllPost()
    {
        return $this->createQueryBuilder('j')
            ->select('j')
            ->orderBy('j.createdAt' , 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
    /*
    public function findOneBySomeField($value): ?JobPosts
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}