<?php

namespace App\Repository;

use App\Entity\NesletterCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NesletterCategorie>
 *
 * @method NesletterCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method NesletterCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method NesletterCategorie[]    findAll()
 * @method NesletterCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NesletterCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NesletterCategorie::class);
    }

//    /**
//     * @return NesletterCategorie[] Returns an array of NesletterCategorie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NesletterCategorie
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
