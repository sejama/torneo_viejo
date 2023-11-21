<?php

namespace App\Repository;

use App\Entity\ZonaEquipo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ZonaEquipo>
 *
 * @method ZonaEquipo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZonaEquipo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZonaEquipo[]    findAll()
 * @method ZonaEquipo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZonaEquipoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZonaEquipo::class);
    }

//    /**
//     * @return ZonaEquipo[] Returns an array of ZonaEquipo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('z.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ZonaEquipo
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
