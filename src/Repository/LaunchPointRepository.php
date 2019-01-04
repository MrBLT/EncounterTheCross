<?php

namespace App\Repository;

use App\Entity\LaunchPoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LaunchPoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method LaunchPoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method LaunchPoint[]    findAll()
 * @method LaunchPoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LaunchPointRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LaunchPoint::class);
    }

    public function findOneRandomly()
    {
        $launchPoints = $this->findAll();
        return $launchPoints[array_rand($launchPoints)];
    }
    // /**
    //  * @return LaunchPoint[] Returns an array of LaunchPoint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LaunchPoint
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
