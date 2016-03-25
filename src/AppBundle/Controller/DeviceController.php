<?php

namespace AppBundle\Controller;

use AppBundle\Service\Messages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Device;


use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Device controller.
 *
 * @Route("/device")
 */
class DeviceController extends Controller
{
    /**
     * Lists all Device entities.
     *
     * @Route("/", name="device_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $devices = $em->getRepository('AppBundle:Device')->findAll();

        $result = array();


        return  new JsonResponse( array(
                'devices' => $result,
                'sucsess' => 'ok',
            )

//        return $this->render('device/index.html.twig', array(
//            'devices' => $devices,
        );
    }

    /**
     * Creates a new Device entity.
     *
     * @Route("/new", name="device_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $device = new Device();
        $form = $this->createForm('AppBundle\Form\DeviceType', $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($device);
            $em->flush();

            return $this->redirectToRoute('device_show', array('id' => $device->getId()));
        }

        return $this->render('device/new.html.twig', array(
            'device' => $device,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Device entity.
     *
     * @Route("/{id}", name="device_show")
     * @Method("GET")
     */
    public function showAction($id)
    {

        /** @var Messages $messages */
        $messages = $this->get('app.messages');
        $device = $this->getDoctrine()->getManager()->getRepository('AppBundle:Device')->find($id);
        /** @var Device $device */
        $messages->getMessages($device);
//        $deleteForm = $this->createDeleteForm($device);

//        return $this->render('device/show.html.twig', array(
//            'device' => $device,
//            'delete_form' => $deleteForm->createView(),
//        ));
//        echo($messages);
    }

    /**
     * Displays a form to edit an existing Device entity.
     *
     * @Route("/{id}/edit", name="device_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Device $device)
    {
        $deleteForm = $this->createDeleteForm($device);
        $editForm = $this->createForm('AppBundle\Form\DeviceType', $device);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($device);
            $em->flush();

            return $this->redirectToRoute('device_edit', array('id' => $device->getId()));
        }

        return $this->render('device/edit.html.twig', array(
            'device' => $device,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Device entity.
     *
     * @Route("/{id}", name="device_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Device $device)
    {
        $form = $this->createDeleteForm($device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($device);
            $em->flush();
        }

        return $this->redirectToRoute('device_index');
    }

    /**
     * Creates a form to delete a Device entity.
     *
     * @param Device $device The Device entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Device $device)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('device_delete', array('id' => $device->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
