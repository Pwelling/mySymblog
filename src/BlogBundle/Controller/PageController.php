<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Enquiry;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('BlogBundle:Page:index.html.twig', ['blogs' => $this->get('blog_helper')->getBlogs()]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction()
    {
        return $this->render('BlogBundle:Page:about.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm('BlogBundle\Form\EnquiryType', $enquiry);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email
                $message = \Swift_Message::newInstance()
                    ->setSubject('Verzoek tot contact vanaf irisopavontuur.nl')
                    ->setFrom('contact@irisopavontuur.nl')
                    ->setTo($this->container->getParameter('blogbundle.emails.contact_email'))
                    ->setBody(
                        $this->renderView('BlogBundle:Email:contactEmail.html.twig', ['enquiry' => $enquiry]),
                        'text/html'
                    );
                $this->get('mailer')->send($message);

                $this->addFlash('success', 'Het bericht is succesvol verzonden.');
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirectToRoute('Blogbundle_contact');
            }
        }

        return $this->render('BlogBundle:Page:contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sidebarAction()
    {
        $tags = $this->get('blog_helper')->getTags();
        $tagWeights = $this->get('blog_helper')->getTagWeights($tags);

        return $this->render('BlogBundle:Page:sidebar.html.twig', [
            'latestComments'    => $this->get('comment_helper')->getLatestComments(),
            'tags' => $tagWeights
        ]);
    }
}
