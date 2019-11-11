<?php

namespace App\Repository;

use App\Entity\StationData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StationData|null find($id, $lockMode = null, $lockVersion = null)
 * @method StationData|null findOneBy(array $criteria, array $orderBy = null)
 * @method StationData[]    findAll()
 * @method StationData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StationDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StationData::class);
    }

    // /**
    //  * @return StationData[] Returns an array of StationData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StationData
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
