<?php

namespace App\Repository;

use App\Entity\ProfTuteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfTuteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfTuteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfTuteur[]    findAll()
 * @method ProfTuteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfTuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfTuteur::class);
    }

    // /**
    //  * @return ProfTuteur[] Returns an array of ProfTuteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProfTuteur
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
