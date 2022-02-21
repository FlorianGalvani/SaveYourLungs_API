<?php

namespace App\Repository;

use App\Entity\StepsStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StepsStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method StepsStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method StepsStats[]    findAll()
 * @method StepsStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StepsStatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StepsStats::class);
    }

    // /**
    //  * @return StepsStats[] Returns an array of StepsStats objects
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
    public function findOneBySomeField($value): ?StepsStats
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
