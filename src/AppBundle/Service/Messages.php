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
    public function getMessages(Device $device)
    {

           $some = $this->getEntityRepository('AppBundle:Message')->getMessagesForDevice($device);

        return $some;
    }
}
