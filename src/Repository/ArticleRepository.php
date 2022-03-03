<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
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

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Article $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Article $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param $value Search
    * @return Article[] Returns an array of Article by search
    */
    public function findBySearch($value)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT id, name, type, size, keyword, image_url AS imageUrl FROM article a
            WHERE a.type = :type
            UNION 
            SELECT id, name, type, size, keyword, image_url AS imageUrl FROM article a
            WHERE a.keyword LIKE :keyword
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['type' => $value, "keyword" => '%' . $value . '%']);
        return $resultSet->fetchAllAssociative();
    }

    /**
     * @param $type String Type of the article
     * @param $size String Size of the article
     * @return Article[] Returns an array of Article by filter
     */
    public function findByFilter($type, $size){
        $article = $this->createQueryBuilder("a")->andWhere("a.type = :type")
        ->setParameter("type", $type);
        if($size != null) {
            $article->andWhere("a.size = :size")
            ->setParameter("size", $size);
        }
        return $article->getQuery()->getResult();
    }
}
