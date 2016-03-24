<?php

namespace AppBundle\Entity;

use Doctrine\DBAL\Platforms;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\AST\Functions;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;
//use Doctrine\DBAL\Query\Expression\ExpressionBuilder;

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
            ->leftJoin('AppBundle:Device', 'dv', 'WITH', 'dv.id LIKE :dev.id')
            ->leftJoin('dv.includeInGroup', 'gr', 'WITH', 'gr.id = n.targetGroup')
            ->leftJoin('n.informedDevices', 'indev', 'WITH', 'indev.id IS NOT NULL')
            ->andWhere("n.targetDevice = dv.id")
            ->orWhere("gr.id = n.targetGroup")
            ->andWhere("indev.id != dv.id OR indev.id IS NULL")
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
        $device = 3;
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
            ->andWhere("n.targetDevice = dv.id")
            ->orWhere("gr.id = n.targetGroup")
            ->andWhere("indev.id != dv.id OR indev.id IS NULL")
            ->setParameter('now', $now)
            ->setParameter('dev', $device)
            ->getQuery()->execute();
    }

    public function getMessFromSelect ()
    {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle\Entity\Message', 'm');
        $rsm->addFieldResult('m', 'id', 'id');
        $rsm->addFieldResult('m', 'name', 'name');
        $rsm->addFieldResult('m', 'text', 'text');
        $rsm->addFieldResult('m', 'expiration', 'expiration');
        $rsm->addFieldResult('m', 'created_at', 'createdAt');
        $device = 2;
        $em = $this->getEntityManager();
        $query =$em->createNativeQuery('SELECT
  m.*
  , md.*
  , dg.*

FROM
  message m
  LEFT JOIN md ON (m.id = md.message_id AND md.device_id = :device)
  JOIN device_group_of dg ON (dg.device_id = :device AND m.targetGroup = dg.group_of_id AND md.message_id IS NULL )
WHERE
  (NOW() <= DATE_ADD(m.targetDate, INTERVAL m.expiration DAY) AND m.targetDate <= NOW())
  OR
  (m.targetDate IS NULL AND (NOW() <= DATE_ADD(m.created_at,INTERVAL m.expiration DAY) AND m.created_at <= NOW()))

;
', $rsm);

        return $query->setParameter('device', $device)->getResult();
    }

    public function getAnotherMetod()
    {
        $device = 2;

        return $this->createQueryBuilder('m')
            ->leftJoin('m.informedDevices', 'md', 'WITH', 'md.id = :device' )
            ->join(':device.groupOf', 'dg', 'WITH', 'm.targetCroup = dg.id AND md.id IS NULL')


            ;
    }

    public function getSomeThing ()
    {
        $device = $this->getEntityManager()->getRepository('AppBundle:Device')
            ->createQueryBuilder('d')
            ->where('d.id = 2')
            ->getQuery()->execute();

//        $dg = $device->getIncludeInGroup();
        $in = $this->getEntityManager()->getRepository('AppBundle:GroupOf')
            ->createQueryBuilder('g')
            ->select('g.id')
            ->where(':device MEMBER OF g.members');

        $dg = $in->setParameter('device', $device)->getQuery()->execute();



        $q = $this->createQueryBuilder('m');
//                ->where($q->expr()->notIn('m.targetGroup', $in->getDQL()))
                $qq = $q->add('where', $q->expr()->in('m.targetGroup', $in->getDQL()))
                ->orWhere('m.targetDevice = :device')
                ->setParameter('device', $device)
//                ->setParameter('dg', $dg);
;
        return $qq->getQuery()->execute();
//        return $dg;
    }




}