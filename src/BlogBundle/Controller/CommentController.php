<?php

namespace BlogBundle\Controller;

use BlogBundle\Form\CommentType;
use BlogBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, $id)
    {
        $blog = $this->get('blog_helper')->getBlog($id);

        $comment  = new Comment();
        $comment->setBlog($blog);

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('comment_helper')->storeComment($comment);

            return $this->redirect(
                $this->generateUrl(
                    'BlogBundle_blog_show',
                    ['id' => $comment->getBlog()->getId(), 'slug' => $comment->getBlog()->getSlug()]
                ) .'#comment-' . $comment->getId()
            );
        }

        return $this->render('BlogBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }
}
