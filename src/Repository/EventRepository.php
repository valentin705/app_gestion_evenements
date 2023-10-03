<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findAllOrderedByStartDate(): array
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.startDateTime', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // Query to fetch all events between two specific dates
    public function findByDateRange(\DateTime $start, \DateTime $end): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.startDateTime BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->orderBy('e.startDateTime', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findEventsByParticipant(User $user): array
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.registeredUsers', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $user->getId())
            ->getQuery()
            ->getResult();
    }

    // Flexible query to fetch events based on a start date, 
    // an end date, both, or even without either
    // public function findByDateRange(?\DateTime $start = null, ?\DateTime $end = null): array
    // {
    //     $qb = $this->createQueryBuilder('e');

    //     if ($start) {
    //         $qb->andWhere('e.startDateTime >= :start')
    //             ->setParameter('start', $start);
    //     }

    //     if ($end) {
    //         $qb->andWhere('e.startDateTime <= :end')
    //             ->setParameter('end', $end);
    //     }

    //     return $qb->orderBy('e.startDateTime', 'ASC')
    //         ->getQuery()
    //         ->getResult();
    // }

    //    /**
    //     * @return Event[] Returns an array of Event objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Event
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
