<?php

namespace App\Repository;

use App\Entity\MaitreApprentissage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaitreApprentissage|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaitreApprentissage|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaitreApprentissage[]    findAll()
 * @method MaitreApprentissage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaitreApprentissageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaitreApprentissage::class);
    }

    // /**
    //  * @return MaitreApprentissage[] Returns an array of MaitreApprentissage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaitreApprentissage
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
