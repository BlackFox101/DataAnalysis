<?php

namespace App\Repository;

use App\Entity\CsseCovid19DailyReport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CsseCovid19DailyReport|null find($id, $lockMode = null, $lockVersion = null)
 * @method CsseCovid19DailyReport|null findOneBy(array $criteria, array $orderBy = null)
 * @method CsseCovid19DailyReport[]    findAll()
 * @method CsseCovid19DailyReport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CsseCovid19DailyReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CsseCovid19DailyReport::class);
    }

    // /**
    //  * @return CsseCovid19DailyReport[] Returns an array of CsseCovid19DailyReport objects
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
    public function findOneBySomeField($value): ?CsseCovid19DailyReport
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
