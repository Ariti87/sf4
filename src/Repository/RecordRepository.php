<?php

namespace App\Repository;

use App\Entity\Record;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Record|null find($id, $lockMode = null, $lockVersion = null)
 * @method Record|null findOneBy(array $criteria, array $orderBy = null)
 * @method Record[]    findAll()
 * @method Record[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Record::class);
    }

    public function getLastMonthReleases()
    {
        return $this->createQueryBuilder('r')
            ->where('r.releasedAt > :last_month')
            ->setParameter('last_month', new \DateTime('-1 month'))
            ->orderBy('r.releasedAt','DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupérer le top 100
     * (Records les mieux notés sortis il y a moins d'un an)
     */
    public function getBestRatedOfYear()
    {
        return $this->createQueryBuilder('r')
            ->innerJoin('r.notes','n')
            ->where('r.releasedAt > :last_year')
            ->setParameter('last_year', new \DateTime('-1 year'))
            ->setMaxResults('100')
            ->groupBy('r.id')
            ->orderBy('AVG(n.value)','DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Record[] Returns an array of Record objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Record
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
