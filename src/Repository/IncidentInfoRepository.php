<?php

namespace App\Repository;

use App\Entity\IncidentInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IncidentInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncidentInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncidentInfo[]    findAll()
 * @method IncidentInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncidentInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncidentInfo::class);
    }

    // /**
    //  * @return IncidentInfo[] Returns an array of IncidentInfo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IncidentInfo
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
