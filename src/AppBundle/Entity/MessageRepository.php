<?php

namespace AppBundle\Entity;

use Doctrine\DBAL\Platforms;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\AST\Functions;

class MessageRepository extends EntityRepository
{
    /**
     * @param Device $device
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getMessDev (Device $device)
    {
        $now = date('Y-m-d');

        return $this->createQueryBuilder('n')

            ->andWhere(":now <= DATE_ADD(n.targetDate, n.expiration, 'day') AND n.targetDate <= :now")
            ->orWhere("n.targetDate IS NULL AND :now <= DATE_ADD(n.createdAt, n.expiration, 'day') AND n.createdAt <= :now")
            ->leftJoin('AppBundle:Device', 'dv', 'WITH', 'dv.id LIKE :dev')
            ->leftJoin('dv.includeInGroup', 'gr', 'WITH', 'gr.id = n.targetGroup')
            ->andWhere("n.targetDevice = dv.id")
            ->orWhere("gr.id = n.targetGroup")
            //andWhere чобы показанные не показывать
            ->setParameter('now', $now)
            ->setParameter('dev', $device)
            ->getQuery()->execute();
    }

//    /**
//     * @param $dev
//     * @return \Doctrine\ORM\QueryBuilder
//     */
//    public function getMessagesForDevice($dev)
//    {
//        $now = date('Y-m-d');
//
//        return $this->createQueryBuilder('n')
//            ->andWhere(":now <= DATE_ADD(n.targetDate, n.expiration, 'day') AND n.targetDate <= :now")
//            ->andWhere(":dev = n.targetDevice")
//
//            ->setParameter('now', $now)
//            ->setParameter('dev', $dev)
//            ->getQuery()->execute();
//
//    }

    /**
     * @param string $group
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getMessagesForGroup($group)
    {
        $now = date('Y-m-d');

        return $this->createQueryBuilder('n')
            ->andWhere(":now <= DATE_ADD(n.targetDate, n.expiration, 'day') AND n.targetDate <= :now")
            ->andWhere(":grp = n.targetGroup")
            ->setParameter('now', $now)
            ->setParameter('grp', $group)
            ->getQuery()->execute();

    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getActiveMessages()
    {
        $now = date('Y-m-d');
        $device = 2;
//        $groupname = '2';

        return $this->createQueryBuilder('n')
//            ->andWhere(":now < DATE_ADD(n.targetDate, n.expiration, 'day') AND n.targetDate < :now")
//            ->orWhere("n.targetDate IS NULL AND :now <= DATE_ADD(n.createdAt, n.expiration, 'day') AND n.createdAt <= :now")
//            ->andWhere("n.targetDevice IS NULL")
//            ->setParameter('now', $now)
//            ->getQuery()->execute(); // old query
            ->andWhere(":now <= DATE_ADD(n.targetDate, n.expiration, 'day') AND n.targetDate <= :now")
            ->orWhere("n.targetDate IS NULL AND :now <= DATE_ADD(n.createdAt, n.expiration, 'day') AND n.createdAt <= :now")

            ->leftJoin('AppBundle:Device', 'dv', 'WITH', 'dv.id LIKE :dev')
            ->leftJoin('dv.includeInGroup', 'gr', 'WITH', 'gr.id = n.targetGroup')
            ->leftJoin('n.informedDevices', 'indev', 'WITH', 'indev.id IS NOT NULL')
//            ->leftJoin('AppBundle:Device', 'dvv', 'WITH', 'dvv.id LIKE :dev')
//            ->leftJoin('dv.viewedMessages', 'vm', 'WITH', 'vm.id = n.id')
//            ->innerJoin('dv.viewedMessages', 'nw', 'WITH', 'nw.informedDevices != n.id')
            ->andWhere("n.targetDevice = dv.id")
            ->orWhere("gr.id = n.targetGroup")
            ->andWhere("indev.id IS NULL")
//            ->innerJoin('n.informedDevices', 'dvv', 'WITH', 'n.informedDevices != dvv')
            ->setParameter('now', $now)
            ->setParameter('dev', $device)
            ->getQuery()->execute();



    }




}