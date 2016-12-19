<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Besoin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Besoin controller.
 *
 * @Route("besoin")
 */
class BesoinController extends Controller
{
    /**
     * Lists all besoin entities.
     *
     * @Route("/", name="besoin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $besoins = $em->getRepository('AppBundle:Besoin')->findAll();

        return $this->render('besoin/index.html.twig', array(
            'besoins' => $besoins,
        ));
    }

    /**
     * Creates a new besoin entity.
     *
     * @Route("/new", name="besoin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $besoin = new Besoin();
        $form = $this->createForm('AppBundle\Form\BesoinType', $besoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($besoin);
            $em->flush($besoin);

            return $this->redirectToRoute('besoin_show', array('id' => $besoin->getId()));
        }

        return $this->render('besoin/new.html.twig', array(
            'besoin' => $besoin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a besoin entity.
     *
     * @Route("/{id}", name="besoin_show")
     * @Method("GET")
     */
    public function showAction(Besoin $besoin)
    {
        $deleteForm = $this->createDeleteForm($besoin);

        return $this->render('besoin/show.html.twig', array(
            'besoin' => $besoin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing besoin entity.
     *
     * @Route("/{id}/edit", name="besoin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Besoin $besoin)
    {
        $deleteForm = $this->createDeleteForm($besoin);
        $editForm = $this->createForm('AppBundle\Form\BesoinType', $besoin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('besoin_edit', array('id' => $besoin->getId()));
        }

        return $this->render('besoin/edit.html.twig', array(
            'besoin' => $besoin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a besoin entity.
     *
     * @Route("/{id}", name="besoin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Besoin $besoin)
    {
        $form = $this->createDeleteForm($besoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($besoin);
            $em->flush($besoin);
        }

        return $this->redirectToRoute('besoin_index');
    }

    /**
     * Creates a form to delete a besoin entity.
     *
     * @param Besoin $besoin The besoin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Besoin $besoin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('besoin_delete', array('id' => $besoin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
