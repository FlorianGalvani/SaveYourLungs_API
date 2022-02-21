<?php

namespace App\Repository;

use App\Entity\CigarettesStat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CigarettesStat|null find($id, $lockMode = null, $lockVersion = null)
 * @method CigarettesStat|null findOneBy(array $criteria, array $orderBy = null)
 * @method CigarettesStat[]    findAll()
 * @method CigarettesStat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CigarettesStatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CigarettesStat::class);
    }

    // /**
    //  * @return CigarettesStat[] Returns an array of CigarettesStat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CigarettesStat
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
