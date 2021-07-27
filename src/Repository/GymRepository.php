<?php

namespace App\Repository;

use App\Entity\Gym;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Gym|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gym|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gym[]    findAll()
 * @method Gym[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GymRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gym::class);
    }


    public function findSearch(?string $search){
        $queryBuilder = $this->createQueryBuilder('g')
        ->Where('g.name like :search OR g.adress like :search OR g.email like :search OR g.city like :search')
        //cherche moi dans la table 'g' (gym) le name ou l'adresse ou l'email ou la ville
        ->setParameter('search', '%' . $search . '%')
        ->getQuery();

        return $queryBuilder->getResult();
    }


    // /**
    //  * @return Gym[] Returns an array of Gym objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gym
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
