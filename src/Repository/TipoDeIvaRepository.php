<?php

namespace App\Repository;

use App\Entity\TipoDeIva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TipoDeIva>
 *
 * @method TipoDeIva|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoDeIva|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoDeIva[]    findAll()
 * @method TipoDeIva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoDeIvaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoDeIva::class);
    }

    public function add(TipoDeIva $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TipoDeIva $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TipoDeIva[] Returns an array of TipoDeIva objects
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

//    public function findOneBySomeField($value): ?TipoDeIva
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
