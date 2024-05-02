<?php

namespace App\Repository;

use App\Entity\TerceroCuarto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TerceroCuarto>
 *
 * @method TerceroCuarto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TerceroCuarto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TerceroCuarto[]    findAll()
 * @method TerceroCuarto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TerceroCuartoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TerceroCuarto::class);
    }

    //    /**
    //     * @return TerceroCuarto[] Returns an array of TerceroCuarto objects
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

    //    public function findOneBySomeField($value): ?TerceroCuarto
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
