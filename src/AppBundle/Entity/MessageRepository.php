<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{
    /**
     * @param Device $device
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getMessagesForDevice(Device $device)
    {
        $now = date('Y-m-d');

        return $this->createQueryBuilder('b')
            ->
            ->getQuery()->execute();
    }

}