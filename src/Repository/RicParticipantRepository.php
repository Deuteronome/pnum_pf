<?php

namespace App\Repository;

use App\Entity\RicParticipant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RicParticipant>
 *
 * @method RicParticipant|null find($id, $lockMode = null, $lockVersion = null)
 * @method RicParticipant|null findOneBy(array $criteria, array $orderBy = null)
 * @method RicParticipant[]    findAll()
 * @method RicParticipant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RicParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RicParticipant::class);
    }

    //    /**
    //     * @return RicParticipant[] Returns an array of RicParticipant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RicParticipant
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
