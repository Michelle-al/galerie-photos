<?php

namespace App\Repository;

use App\Entity\Repertoire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;

/**
 * @method Repertoire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Repertoire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Repertoire[]    findAll()
 * @method Repertoire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepertoireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Repertoire::class);
    }

    /**
    * @return Repertoire[] Returns an array of Repertoire objects
    */
    
    public function findCount()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->getResult()
        ;
    }

     /**
    * @return Repertoire[] Returns an array of Repertoire objects
    */
    public function getCustomiseFilter($propriete, $value){
        return $this->createQueryBuilder('t')
            ->andWhere('t.'.$propriete.' = '. $value)
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
     /**
    * @return Repertoire[] Returns an array of Repertoire objects
    */
    public function findByTag($tag){
        return $this->createQueryBuilder('r')
            ->innerJoin('r.tags', 't')
            ->addSelect('t')
            ->andWhere('t.libelle = :tag')
            ->setParameter('tag', $tag)
            ->getQuery()
            ->getResult();
    }   
    //     $em = $this->getEntityManager();

    //     return $em->createQuery(
    //         'SELECT r FROM App\Entity\Repertoire r, App\Entity\Tag t,  WHERE r.tags = t.id AND t.libelle= :tag'
    //     )
    //     ->setParameter('tag', $tag)
    //     ->execute();
    // }
   
    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('r')
    //         ->andWhere('r.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('r.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    /*
    public function findOneBySomeField($value): ?Repertoire
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
