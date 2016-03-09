<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\AST\Functions;

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

//        return $this->createQueryBuilder('b')
//            ->andWhere(':now > :begin AND :now < :end')
//            ->join('AppBundle:Device', 'devi', 'WITH', 'b.device = devi.id')
//            ->setParameter('begin', $begin)
//            ->setParameter('end', $end)
//            ->setParameter('did', $device)
//            ->setParameter('now', $now)
//            ->getQuery()->execute();


        $sql = $this->createQueryBuilder('b' );


    }
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getMessagesNotExpirated ()
    {
//        $now = date('Y-m-d');

//        return $this->createQueryBuilder('n')
//            ->andWhere(DATE_ADD(n.targetDate, n.expiration, "day" ));
    }

}