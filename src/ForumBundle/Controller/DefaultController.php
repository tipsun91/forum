<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Forum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Lists all Forum entities.
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('VIEW', new Forum(), 'Вам отказано в доступе.');

        $em = $this->getDoctrine()->getManager();

        $forums = $em->getRepository('ForumBundle:Forum')->findAll();

        return $this->render('@Forum/index.html.twig', [
            'forums' => $forums,
        ]);
    }
}
