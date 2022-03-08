<?php

namespace App\Repository;

use App\Entity\Utlisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Utlisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utlisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utlisateur[]    findAll()
 * @method Utlisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtlisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utlisateur::class);
    }

    // /**
    //  * @return Utlisateur[] Returns an array of Utlisateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Utlisateur
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
