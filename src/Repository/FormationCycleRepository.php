<?php

namespace App\Repository;

use App\Data\SearchPage;
use App\Entity\FormationCycle;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<FormationCycle>
 *
 * @method FormationCycle|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormationCycle|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormationCycle[]    findAll()
 * @method FormationCycle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationCycleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormationCycle::class);
    }

    public function save(FormationCycle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FormationCycle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBysearch(SearchPage $searchPage): array
    {
    $query = $this->createQueryBuilder('f');
        if (!empty($searchPage->searchText)) {
            $query->andWhere('MATCH_AGAINST(f.label, f.description) AGAINST(:searchText boolean)>0')
                ->setParameter('searchText', $searchPage->searchText);

        }        
        return $query->getQuery()
            
        ->getResult()
       ;
    }

    //    /**
    //     * @return FormationCycle[] Returns an array of FormationCycle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?FormationCycle
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
