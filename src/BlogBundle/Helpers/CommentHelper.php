<?php
namespace BlogBundle\Helpers;

use BlogBundle\Entity\Comment;
use Symfony\Component\DependencyInjection\Container;

class CommentHelper
{
    /**
     * @var Container
     */
    private $container;

    /**
     * CommentHelper constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @param Comment $comment
     */
    public function storeComment(Comment $comment)
    {
        $entityManager = $this->container->get('doctrine')->getManager();
        $entityManager->persist($comment);
        $entityManager->flush();
    }

    /**
     * @return Comment[]
     */
    public function getLatestComments()
    {
        $entityManager = $this->container->get('doctrine')->getManager();

        $commentLimit   = $this->container->getParameter('blogbundle.comments.latest_comment_limit');
        return $entityManager->getRepository('BlogBundle:Comment')->getLatestComments($commentLimit);

    }
}