<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Comment;
use BlogBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request, $id, $slug)
    {
        $em = $this->get('doctrine');
        $blog = $em->getRepository('BlogBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Blog niet gevonden....');
        }
        $comment = new Comment();
        $comment->setBlog($blog);
        $form   = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('comment_helper')->storeComment($comment);

            return $this->redirect(
                $this->generateUrl(
                    'BlogBundle_blog_show',
                    ['id' => $blog->getId(), 'slug' => $slug]
                ) .'#comment-' . $comment->getId()
            );
        }

        $comments = $em->getRepository('BlogBundle:Comment')->getCommentsForBlog($blog->getId());
        return $this->render('BlogBundle:Blog:show.html.twig', [
            'blog'      => $blog,
            'comments'  => $comments,
            'form' => $form->createView(),
        ]);
    }
}
