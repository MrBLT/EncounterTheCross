<?php

namespace App\Repository;

use App\Entity\EventServer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EventServer|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventServer|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventServer[]    findAll()
 * @method EventServer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventServerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EventServer::class);
    }

    // /**
    //  * @return EventServer[] Returns an array of EventServer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventServer
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
