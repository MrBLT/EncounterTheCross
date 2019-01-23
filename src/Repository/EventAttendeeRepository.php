<?php

namespace App\Repository;

use App\Entity\EventAttendee;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EventAttendee|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventAttendee|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventAttendee[]    findAll()
 * @method EventAttendee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventAttendeeRepository extends BaseRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EventAttendee::class);
    }

    // /**
    //  * @return EventAttendee[] Returns an array of EventAttendee objects
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
    public function findOneBySomeField($value): ?EventAttendee
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
