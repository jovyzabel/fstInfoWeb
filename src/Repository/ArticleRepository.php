<?php

namespace App\Repository;

use App\Data\SearchNews;
use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   public function findBysearch(SearchNews $searchNews): array
   {
    $query = $this->createQueryBuilder('a');
        if (!empty($searchNews->searchText)) {
            $query->andWhere('MATCH_AGAINST(a.title, a.content) AGAINST(:searchText boolean)>0')
                ->setParameter('searchText', $searchNews->searchText);

        }
        
        if (!empty($searchNews->categories)) {
            foreach ($searchNews->categories as $category) {
                $query->andWhere(':category MEMBER OF a.categories')
                ->setParameter('category', $category);
                
            }

        }

        if (!empty($searchNews->tags)) {
            foreach ($searchNews->tags as $tag ) {
                $query->andWhere(':tag MEMBER OF a.tags')
                ->setParameter('tag', $tag);
                
            }

        }
        if (!empty($searchNews->minDate)) {
            $query->andWhere('a.createdAt >= :minDate')
                ->setParameter('minDate', $searchNews->minDate);
                
            

        }
        
           return $query->orderBy('a.createdAt', 'DESC')
           ->getQuery()
           ->getResult()
       ;
   }
    

//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
