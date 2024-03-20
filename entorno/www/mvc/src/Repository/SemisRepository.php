<?php

namespace App\Repository;

use App\Entity\Semis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Semis>
 *
 * @method Semis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Semis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Semis[]    findAll()
 * @method Semis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SemisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Semis::class);
    }

//    /**
//     * @return Semis[] Returns an array of Semis objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Semis
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
