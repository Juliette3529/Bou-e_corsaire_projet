<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();

        $besoin = $em->getRepository('AppBundle:Besoin')->findBy(['id' => 1]);
        $besoin = $besoin[0];
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'besoin' => $besoin,
        ]);
    }
	
	/**
     * @Route("/admin", name="adminpage")
     */
	public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
	
	/**
     * @Route("/admin/user", name="supUser")
     */
	public function adminDelete()
    {
        return new Response('<html><body>Admin page for delete user!</body></html>');
    }
	

}
