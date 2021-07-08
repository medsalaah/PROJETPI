<?php

namespace App\Repository;

use App\Entity\Lignelocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lignelocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lignelocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lignelocation[]    findAll()
 * @method Lignelocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignelocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lignelocation::class);
    }

    // /**
    //  * @return Lignelocation[] Returns an array of Lignelocation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lignelocation
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
