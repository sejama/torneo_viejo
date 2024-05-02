<?php

namespace App\Repository;

use App\Entity\Triangular;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Triangular>
 *
 * @method Triangular|null find($id, $lockMode = null, $lockVersion = null)
 * @method Triangular|null findOneBy(array $criteria, array $orderBy = null)
 * @method Triangular[]    findAll()
 * @method Triangular[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TriangularRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Triangular::class);
    }

    //    /**
    //     * @return Triangular[] Returns an array of Triangular objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Triangular
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
