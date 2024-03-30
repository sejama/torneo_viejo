<?php

namespace App\Repository;

use App\Entity\Fin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fin>
 *
 * @method Fin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fin[]    findAll()
 * @method Fin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fin::class);
    }

    public function saveFin(Fin $fin): Fin
    {
        $this->_em->persist($fin);
        $this->_em->flush();

        return $fin;
    }

//    /**
//     * @return Fin[] Returns an array of Fin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Fin
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
