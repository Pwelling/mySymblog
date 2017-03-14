<?php
namespace BlogBundle\Helpers;

use BlogBundle\Entity\Blog;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class BlogHelper
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var EntityManager
     */
    private $doctrine;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->doctrine = $this->container->get('doctrine');
        return $this;
    }

    /**
     * @return Blog[]
     */
    public function getBlogs()
    {
        $blogs = $this->doctrine->getRepository('BlogBundle:Blog')->getLatestBlogs();
        return $blogs;
    }

    /**
     * @param $blog_id
     * @return null|Blog
     */
    public function getBlog($blog_id)
    {
        return $this->doctrine->getRepository('BlogBundle:Blog')->find($blog_id);
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->doctrine->getRepository('BlogBundle:Blog')->getTags();
    }

    public function getTagWeights($tags)
    {
        return $this->doctrine->getRepository('BlogBundle:Blog')->getTagWeights($tags);
    }
}