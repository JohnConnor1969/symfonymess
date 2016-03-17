<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/16/2016
 * Time: 7:24 PM
 */

namespace AppBundle\Service;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Device;
use AppBundle\Entity\Message;

class DeliveryMessages
{
    public function getCurrentMessages(Device $device)
    {
        $currentMessages = array();

        //find by uniqueId
        $device->getUniqueId(); //придет строкой
        $res = array();
        $test = 'group2';
//        $em = $this->getDoctrine()->getManager();

        $res[] = $this->getDoctrine()->getManager()->getRepository('AppBundle:Message')->getMessagesForGroup($test);


        $currentMessages[] = $res;


        //find by each includeInGroup
        $listgroups = array();
        $groups = $device->getIncludeInGroup(); //придет объектом....

        foreach ($groups as $group){
            $listgroups[] = $group->toString(); // делаем массивом
        }


        $currentMessages[] = $res;

        return $currentMessages;

    }

    public function getSomeMessages ($test)
    {
        return $this->getRepository('AppBundle:Message')->getMessagesForGroup($test);
    }


}
