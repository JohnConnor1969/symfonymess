<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\GroupOf;
use AppBundle\Form\GroupOfType;

/**
 * GroupOf controller.
 *
 * @Route("/groupof")
 */
class GroupOfController extends Controller
{
    /**
     * Lists all GroupOf entities.
     *
     * @Route("/", name="groupof_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupOfs = $em->getRepository('AppBundle:GroupOf')->findAll();

        return $this->render('groupof/index.html.twig', array(
            'groupOfs' => $groupOfs,
        ));
    }

    /**
     * Creates a new GroupOf entity.
     *
     * @Route("/new", name="groupof_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $groupOf = new GroupOf();
        $form = $this->createForm('AppBundle\Form\GroupOfType', $groupOf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupOf);
            $em->flush();

            return $this->redirectToRoute('groupof_show', array('id' => $groupOf->getId()));
        }

        return $this->render('groupof/new.html.twig', array(
            'groupOf' => $groupOf,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GroupOf entity.
     *
     * @Route("/{id}", name="groupof_show")
     * @Method("GET")
     */
    public function showAction(GroupOf $groupOf)
    {
        $deleteForm = $this->createDeleteForm($groupOf);

        return $this->render('groupof/show.html.twig', array(
            'groupOf' => $groupOf,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GroupOf entity.
     *
     * @Route("/{id}/edit", name="groupof_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GroupOf $groupOf)
    {
        $deleteForm = $this->createDeleteForm($groupOf);
        $editForm = $this->createForm('AppBundle\Form\GroupOfType', $groupOf);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupOf);
            $em->flush();

            return $this->redirectToRoute('groupof_edit', array('id' => $groupOf->getId()));
        }

        return $this->render('groupof/edit.html.twig', array(
            'groupOf' => $groupOf,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GroupOf entity.
     *
     * @Route("/{id}", name="groupof_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GroupOf $groupOf)
    {
        $form = $this->createDeleteForm($groupOf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupOf);
            $em->flush();
        }

        return $this->redirectToRoute('groupof_index');
    }

    /**
     * Creates a form to delete a GroupOf entity.
     *
     * @param GroupOf $groupOf The GroupOf entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GroupOf $groupOf)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('groupof_delete', array('id' => $groupOf->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
