<?php

namespace App\Repository;

use App\Entity\ShippingInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShippingInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippingInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippingInfo[]    findAll()
 * @method ShippingInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippingInfo::class);
    }

    // /**
    //  * @return ShippingInfo[] Returns an array of ShippingInfo objects
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
    public function findOneBySomeField($value): ?ShippingInfo
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
