<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Message;

/**
 * Message controller.
 *
 * @Route("/message")
 */
class MessageController extends Controller
{
    /**
     * Lists all Message entities.
     *
     * @Route("/", name="message_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('AppBundle:Message')->getMessagesForDevice();

        $result = array();
        foreach ($messages as $message) {
            $b = $message->toArray();
            $result[] = $b;
        }


        return  new JsonResponse( array(
                'messages' => $result,
                'sucsess' => 'ok',
            )
        );


    }


}
