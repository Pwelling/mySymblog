<?php

namespace BlogBundle\Tests\Entity;

use BlogBundle\Entity\Blog;
use BlogBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BlogTest extends KernelTestCase
{
    /**
     * @var Blog
     */
    protected $object;

    /**
     *
     */
    protected function setUp()
    {
        $this->object = new Blog();
    }

    /**
     * @covers \BlogBundle\Entity\Blog::__construct
     * @covers \BlogBundle\Entity\Blog::getCreated
     * @covers \BlogBundle\Entity\Blog::getUpdated
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(Blog::class, $this->object);
        $this->assertNotNull($this->object->getCreated());
        $this->assertNotNull($this->object->getUpdated());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::getId
     */
    public function testGetId()
    {
        $this->assertNull($this->object->getId());
        $reflectionProperty = new \ReflectionProperty('BlogBundle\Entity\Blog', 'id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->object, 22);
        $this->assertSame(22, $this->object->getId());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::getTitle
     * @covers \BlogBundle\Entity\Blog::getSlug
     * @covers \BlogBundle\Entity\Blog::setTitle
     * @covers \BlogBundle\Entity\Blog::setSlug
     * @covers \BlogBundle\Entity\Blog::slugify
     */
    public function testGetSetTitle()
    {
        $this->assertNull($this->object->getTitle());
        $this->assertNull($this->object->getSlug());
        $title = 'My Title';
        $this->assertSame($title, $this->object->setTitle($title)->getTitle());
        $this->assertSame('my-title', $this->object->getSlug());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::getAuthor
     * @covers \BlogBundle\Entity\Blog::setAuthor
     */
    public function testGetSetAuthor()
    {
        $this->assertNull($this->object->getAuthor());
        $author = 'my Author';
        $this->assertSame($author, $this->object->setAuthor($author)->getAuthor());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::getBlog
     * @covers \BlogBundle\Entity\Blog::setBlog
     */
    public function testGetSetBlog()
    {
        $this->assertNull($this->object->getBlog());
        $blog = 'A piece of text that was written as a blog-body...';
        $this->assertSame($blog, $this->object->setBlog($blog)->getBlog());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::getImage
     * @covers \BlogBundle\Entity\Blog::setImage
     */
    public function testGetSetImage()
    {
        $this->assertNull($this->object->getImage());
        $imageString = 'My imagestring';
        $this->assertSame($imageString, $this->object->setImage($imageString)->getImage());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::getTags
     * @covers \BlogBundle\Entity\Blog::setTags
     */
    public function testGetSetTags()
    {
        $this->assertNull($this->object->getTags());
        $tags = 'Tag1, Tag2';
        $this->assertSame($tags, $this->object->setTags($tags)->getTags());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::getCreated
     * @covers \BlogBundle\Entity\Blog::setCreated
     */
    public function testGetSetCreated()
    {
        $created = new \DateTime('2016-12-02 21:05:13');
        $this->assertSame($created, $this->object->setCreated($created)->getCreated());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::getUpdated
     * @covers \BlogBundle\Entity\Blog::setUpdated
     */
    public function testGetSetUpdated()
    {
        $updated = new \DateTime('2016-12-02 21:05:13');
        $this->assertSame($updated, $this->object->setUpdated($updated)->getUpdated());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::addComment
     * @covers \BlogBundle\Entity\Blog::getComments
     * @covers \BlogBundle\Entity\Blog::removeComment
     */
    public function testAddGetRemoveComment()
    {
        $this->assertCount(0, $this->object->getComments());
        $comment = new Comment();

        $result = $this->object->addComment($comment)->getComments();
        $this->assertCount(1, $result);

        $this->assertCount(0, $this->object->removeComment($comment)->getComments());
    }

    /**
     * @covers \BlogBundle\Entity\Blog::slugify
     */
    public function testSlugify()
    {
        $text = 'I am slugified';
        $slugified = 'i-am-slugified';
        $this->assertSame($slugified, $this->object->slugify($text));

        $text = '';
        $slugified = 'n-a';
        $this->assertSame($slugified, $this->object->slugify($text));
    }
}