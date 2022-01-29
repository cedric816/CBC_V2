<?php

namespace App\Repository;

use App\Entity\Reco;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reco|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reco|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reco[]    findAll()
 * @method Reco[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reco::class);
    }

    /**
    * @return Reco[] Returns an array of Reco objects
    */
    
    public function finReceivedRecos(User $user)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.recipient = :val')
            ->setParameter('val', $user)
            ->orderBy('r.createdAt', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Reco
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
