<?php

namespace App\Repository;

use App\Entity\PlayOff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayOff>
 *
 * @method PlayOff|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayOff|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayOff[]    findAll()
 * @method PlayOff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayOffRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayOff::class);
    }

    public function savePlayOff(PlayOff $playOff): PlayOff
    {
        $this->_em->persist($playOff);
        $this->_em->flush();

        return $playOff;
    }

//    /**
//     * @return PlayOff[] Returns an array of PlayOff objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlayOff
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
