<?php

namespace App\Repository;

use App\Entity\TorneoGeneroCategoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TorneoGeneroCategoria>
 *
 * @method TorneoGeneroCategoria|null find($id, $lockMode = null, $lockVersion = null)
 * @method TorneoGeneroCategoria|null findOneBy(array $criteria, array $orderBy = null)
 * @method TorneoGeneroCategoria[]    findAll()
 * @method TorneoGeneroCategoria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TorneoGeneroCategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TorneoGeneroCategoria::class);
    }

    public function actualizarTGC(TorneoGeneroCategoria $tgc): void
    {
        $tgc->setUpdatedAt(new \DateTimeImmutable('now'));
        $this->_em->flush();
    }

//    /**
//     * @return TorneoGeneroCategoria[] Returns an array of TorneoGeneroCategoria objects
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

//    public function findOneBySomeField($value): ?TorneoGeneroCategoria
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
