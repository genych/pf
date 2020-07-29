<?php

namespace App\Repository;

use App\Entity\ShippingPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShippingPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippingPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippingPrice[]    findAll()
 * @method ShippingPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippingPrice::class);
    }

    // /**
    //  * @return ShippingPrice[] Returns an array of ShippingPrice objects
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
    public function findOneBySomeField($value): ?ShippingPrice
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
