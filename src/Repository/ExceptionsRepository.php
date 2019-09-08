<?php

namespace App\Repository;

use App\Entity\Exceptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Exceptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exceptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exceptions[]    findAll()
 * @method Exceptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExceptionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exceptions::class);
    }

    // /**
    //  * @return Exceptions[] Returns an array of Exceptions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exceptions
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
