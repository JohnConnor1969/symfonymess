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

        return $this->createQueryBuilder('n')
            ->andWhere("DATE_ADD(n.targetDate, n.expiration, 'day') < :now" AND "n.targetDate > :now")
            ->andWhere(":dev.groupOf == n.targetGroup" || ":dev.uniqueId == n.targetDevice")
            ->andWhere("n.informedDevices != :dev")
            ->setParameter('now', $now)
            ->setParameter('dev', $device)
            ->getQuery()->execute();

    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getActiveMessages()
    {
        $now = date('Y-m-d');

        return $this->createQueryBuilder('n')
            ->andWhere("DATE_ADD(n.targetDate, n.expiration, 'day') < :now" AND "n.targetDate > :now")
            ->setParameter('now', $now)
            ->getQuery()->execute();

    }

}