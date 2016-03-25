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
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getMessagesForDevice ()
    {
        $device = $this->getEntityManager()->getRepository('AppBundle:Device')
            ->createQueryBuilder('d')
            ->where('d.id = 2')
            ->getQuery()->execute();

        return $this->createQueryBuilder('m')
            ->join('AppBundle:Device', 'd', 'WITH', 'd = :device')
            ->join('d.groups', 'g', 'WITH', 'g = m.group OR m.device = d.id')
            ->Join('d.messages', 'dm', 'WITH', 'dm <> m')
//            ->Where('dm.id = 1')
//            ->leftJoin('m.devices', 'md', 'WITH', 'md.id = d.id')

//            ->andWhere("CURRENT_DATE() <= DATE_ADD(m.date, m.expiration, 'day') AND m.date <= CURRENT_DATE()")
//            ->orWhere("CURRENT_DATE() <= DATE_ADD(m.createdAt, m.expiration, 'day') AND m.createdAt <= CURRENT_DATE()")
            ->setParameter('device', $device)
            ->getQuery()->execute();

    }

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
}