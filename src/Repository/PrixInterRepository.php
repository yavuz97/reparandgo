<?php

namespace App\Repository;

use App\Entity\PrixInter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrixInter|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrixInter|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrixInter[]    findAll()
 * @method PrixInter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixInterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrixInter::class);
    }

    // /**
    //  * @return PrixInter[] Returns an array of PrixInter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrixInter
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
