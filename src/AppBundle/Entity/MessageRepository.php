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
        $begin = date_create_from_format("Y-m-d H:i:s", $now . " 00:00:00");
        $end = date_create_from_format("Y-m-d H:i:s", $now . " 23:59:59");

        return $this->createQueryBuilder('b')
            ->andWhere('b.date > :now')
            ->join('AppBundle:Device', 'devi', 'WITH', 'b.device = devi.id')
            ->setParameter('begin', $begin)
            ->setParameter('end', $end)
            ->setParameter('pid', $device)
            ->getQuery()->execute();
    }

}