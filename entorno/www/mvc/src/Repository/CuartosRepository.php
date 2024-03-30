<?php

namespace App\Repository;

use App\Entity\Cuartos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cuartos>
 *
 * @method Cuartos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cuartos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cuartos[]    findAll()
 * @method Cuartos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuartosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cuartos::class);
    }

    public function saveCartos(Cuartos $cuartos): Cuartos
    {
        $this->_em->persist($cuartos);
        $this->_em->flush();

        return $cuartos;
    }

//    /**
//     * @return Cuartos[] Returns an array of Cuartos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cuartos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
