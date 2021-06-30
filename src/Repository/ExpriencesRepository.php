<?php

namespace App\Repository;

use App\Entity\Expriences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Expriences|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expriences|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expriences[]    findAll()
 * @method Expriences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpriencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expriences::class);
    }

    // /**
    //  * @return Expriences[] Returns an array of Expriences objects
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
    public function findOneBySomeField($value): ?Expriences
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
