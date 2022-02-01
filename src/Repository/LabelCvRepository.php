<?php

namespace App\Repository;

use App\Entity\LabelCv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LabelCv|null find($id, $lockMode = null, $lockVersion = null)
 * @method LabelCv|null findOneBy(array $criteria, array $orderBy = null)
 * @method LabelCv[]    findAll()
 * @method LabelCv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LabelCvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LabelCv::class);
    }

    // /**
    //  * @return LabelCv[] Returns an array of LabelCv objects
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
    public function findOneBySomeField($value): ?LabelCv
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
