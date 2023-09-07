<?php

namespace App\Repository;

use App\Entity\BaccalaureatDiploma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BaccalaureatDiploma>
 *
 * @method BaccalaureatDiploma|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaccalaureatDiploma|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaccalaureatDiploma[]    findAll()
 * @method BaccalaureatDiploma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaccalaureatDiplomaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BaccalaureatDiploma::class);
    }

    public function save(BaccalaureatDiploma $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BaccalaureatDiploma $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BaccalaureatDiploma[] Returns an array of BaccalaureatDiploma objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BaccalaureatDiploma
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
