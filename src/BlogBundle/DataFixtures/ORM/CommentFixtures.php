<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/CommentFixtures.php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\Comment;

class CommentFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment
            ->setUser('symfony')
            ->setComment(
                'To make a long story short. You can\'t go wrong by choosing Symfony!'
                . ' And no one has ever been fired for using Symfony.'
            )
            ->setBlog($manager->merge($this->getReference('blog-1')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('David')
            ->setComment(
                'To make a long story short. Choosing a framework must not be taken lightly;'
                . 'it is a long-term commitment. Make sure that you make the right selection!'
            )
            ->setBlog($manager->merge($this->getReference('blog-1')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Dade')
            ->setComment('Anything else, mom? You want me to mow the lawn? Oops! I forgot, New York, No grass.')
            ->setBlog($manager->merge($this->getReference('blog-2')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Kate')
            ->setComment('Are you challenging me? ')
            ->setBlog($manager->merge($this->getReference('blog-2')))
            ->setCreated(new \DateTime("2011-07-23 06:15:20"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Dade')
            ->setComment('Name your stakes.')
            ->setBlog($manager->merge($this->getReference('blog-2')))
            ->setCreated(new \DateTime("2011-07-23 06:18:35"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Kate')
            ->setComment('If I win, you become my slave.')
            ->setBlog($manager->merge($this->getReference('blog-2')))
            ->setCreated(new \DateTime("2011-07-23 06:22:53"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Dade')
            ->setComment('Your SLAVE?')
            ->setBlog($manager->merge($this->getReference('blog-2')))
            ->setCreated(new \DateTime("2011-07-23 06:25:15"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Kate')
            ->setComment('You wish! You\'ll do shitwork, scan, crack copyrights...')
            ->setBlog($manager->merge($this->getReference('blog-2')))
            ->setCreated(new \DateTime("2011-07-23 06:46:08"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Dade')
            ->setComment('And if I win?')
            ->setBlog($manager->merge($this->getReference('blog-2')))
            ->setCreated(new \DateTime("2011-07-23 10:22:46"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Kate')
            ->setComment('Make it my first-born!')
            ->setBlog($manager->merge($this->getReference('blog-2')))
            ->setCreated(new \DateTime("2011-07-23 11:08:08"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Dade')
            ->setComment('Make it our first-date!')
            ->setBlog($manager->merge($this->getReference('blog-2')))
            ->setCreated(new \DateTime("2011-07-24 18:56:01"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Kate')
            ->setComment('I don\'t DO dates. But I don\'t lose either, so you\'re on!')
            ->setBlog($manager->merge($this->getReference('blog-2')))
            ->setCreated(new \DateTime("2011-07-25 22:28:42"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Stanley')
            ->setComment('It\'s not gonna end like this.')
            ->setBlog($manager->merge($this->getReference('blog-3')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Gabriel')
            ->setComment(
                'Oh, come on, Stan. Not everything ends the way you think it should.'
                . ' Besides, audiences love happy endings.'
            )
            ->setBlog($manager->merge($this->getReference('blog-3')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Mile')
            ->setComment('Doesn\'t Bill Gates have something like that?')
            ->setBlog($manager->merge($this->getReference('blog-5')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setUser('Gary')
            ->setComment('Bill Who?')
            ->setBlog($manager->merge($this->getReference('blog-5')));
        $manager->persist($comment);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}