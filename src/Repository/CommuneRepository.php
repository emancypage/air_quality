<?php

namespace App\Repository;

use App\Entity\Commune;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Commune|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commune|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commune[]    findAll()
 * @method Commune[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommuneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Commune::class);
    }

    public function getOneByFields($communeName, $districtName, $provinceName): ?Commune
    {
        return $this->createQueryBuilder('commune')
            ->andWhere('commune.communeName = :communeName AND commune.districtName = :districtName AND commune.provinceName = :provinceName')
            ->setParameter('communeName', $communeName)
            ->setParameter('districtName', $districtName)
            ->setParameter('provinceName', $provinceName)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
