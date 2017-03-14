<?php

namespace BlogBundle\EntityRepositories;

use Doctrine\ORM\EntityRepository;
use BlogBundle\Entity\Comment as CommentEntity;

/**
 * Comment
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Comment extends EntityRepository
{
    /**
     * @param $blogId
     * @param bool $approved
     * @return CommentEntity[]
     */
    public function getCommentsForBlog($blogId, $approved = true)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.blog = :blog_id')
            ->addOrderBy('c.created')
            ->setParameter('blog_id', $blogId);

        if (false === is_null($approved)) {
            $queryBuilder
                ->andWhere('c.approved = :approved')
                ->setParameter('approved', $approved);
        }
        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param int $limit
     * @return CommentEntity[]
     */
    public function getLatestComments($limit = 10)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->select('c')
            ->addOrderBy('c.id', 'DESC');

        if (false === is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery()->getResult();
    }
}