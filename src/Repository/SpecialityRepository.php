<?php

namespace App\Repository;

use App\Data\SearchPage;
use App\Entity\Speciality;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Speciality>
 *
 * @method Speciality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Speciality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Speciality[]    findAll()
 * @method Speciality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Speciality::class);
    }

    public function save(Speciality $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Speciality $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBysearch(SearchPage $searchPage): array
    {
    $query = $this->createQueryBuilder('s');
        if (!empty($searchPage->searchText)) {
            $query->andWhere('MATCH_AGAINST(s.label, s.description) AGAINST(:searchText boolean)>0')
                ->setParameter('searchText', $searchPage->searchText);

        }        
        return $query->getQuery()
            
        ->getResult()
       ;
    }

//    /**
//     * @return Speciality[] Returns an array of Speciality objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Speciality
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
