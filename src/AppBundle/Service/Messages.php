<?php

namespace AppBundle\Service;

use AppBundle\AppBundle;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Device;
use AppBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Messages extends Controller
{
    /**
     * @param Device $device
     * @return mixed
     */
    public function getMessages(Device $device)
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('AppBundle:Message')->getMessagesForDevice($device);

        return $messages;
    }
}
