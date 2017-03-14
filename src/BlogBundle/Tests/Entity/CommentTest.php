<?php

namespace BlogBundle\Tests\Entity;

use BlogBundle\Entity\Blog;
use BlogBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentTest extends KernelTestCase
{
    /**
     * @var Comment
     */
    protected $object;

    /**
     *
     */
    protected function setUp()
    {
        $this->object = new Comment();
    }

    /**
     * @covers \BlogBundle\Entity\Comment::__construct
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(Comment::class, $this->object);
    }

    /**
     * @covers \BlogBundle\Entity\Comment::getId
     */
    public function testGetId()
    {
        $reflectionProperty = new \ReflectionProperty('BlogBundle\Entity\Comment', 'id');
        $reflectionProperty->setAccessible(true);

        $reflectionProperty->setValue($this->object, 344);
        $this->assertSame(344, $this->object->getId());
    }

    /**
     * @covers \BlogBundle\Entity\Comment::getUser
     * @covers \BlogBundle\Entity\Comment::setUser
     */
    public function testGetSetUser()
    {
        $this->assertNull($this->object->getUser());
        $user = 'my Name';
        $this->assertSame($user, $this->object->setUser($user)->getUser());
    }

    /**
     * @covers \BlogBundle\Entity\Comment::getComment
     * @covers \BlogBundle\Entity\Comment::setComment
     */
    public function testGetSetComment()
    {
        $this->assertNull($this->object->getComment());
        $comment = 'A comment to a blog';
        $this->assertSame($comment, $this->object->setComment($comment)->getComment());
    }

    /**
     * @covers \BlogBundle\Entity\Comment::getApproved
     * @covers \BlogBundle\Entity\Comment::setApproved
     */
    public function testGetSetApproved()
    {
        $this->assertTrue($this->object->getApproved());
        $this->assertFalse($this->object->setApproved(false)->getApproved());
    }

    /**
     * @covers \BlogBundle\Entity\Comment::getCreated
     * @covers \BlogBundle\Entity\Comment::setCreated
     */
    public function testGetSetCreated()
    {
        $createdTimestamp = new \DateTime('-10 days');
        $this->assertEquals($createdTimestamp, $this->object->setCreated($createdTimestamp)->getCreated());
    }

    /**
     * @covers \BlogBundle\Entity\Comment::getUpdated
     * @covers \BlogBundle\Entity\Comment::setUpdated
     */
    public function testGetSetUpdated()
    {
        $updatedTimestamp = new \DateTime('-10 days');
        $this->assertEquals($updatedTimestamp, $this->object->setUpdated($updatedTimestamp)->getUpdated());
    }

    /**
     * @covers \BlogBundle\Entity\Comment::getBlog
     * @covers \BlogBundle\Entity\Comment::setBlog
     */
    public function testGetSetBlog()
    {
        $this->assertNull($this->object->getBlog());
        $blog = new Blog();
        $this->assertSame($blog, $this->object->setBlog($blog)->getBlog());
    }

    /**
     * @covers \BlogBundle\Entity\Comment::setUpdatedValue
     * @covers \BlogBundle\Entity\Comment::getUpdated
     */
    public function testSetUpdatedValue()
    {
        $dateTime = new \DateTime('-10 days');
        $this->object->setUpdatedValue($dateTime);
        $this->assertEquals($dateTime, $this->object->getUpdated());
    }
}