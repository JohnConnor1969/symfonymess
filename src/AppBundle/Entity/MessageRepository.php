<?php

namespace AppBundle\Entity;

use Doctrine\DBAL\Platforms;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\AST\Functions;
use Doctrine\ORM\Query;


class MessageRepository extends EntityRepository
{
    /**
     *@param Device $device
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getMessagesForDevice (Device $device)
    {

        return $this->createQueryBuilder('m')
            ->leftJoin('AppBundle:Device', 'd', 'WITH', 'd = :device')
            ->leftJoin('d.groups', 'gr', 'WITH', 'gr = m.group')
            ->leftJoin('m.devices', 'md', 'WITH', 'md.id IS NOT NULL')
            ->andWhere("m.device = d.id")
            ->orWhere("gr = m.group")
            ->andWhere("md.id != d.id OR md.id IS NULL")
            ->andWhere("CURRENT_DATE() <= DATE_ADD(m.date, m.expiration, 'day') AND m.date <= CURRENT_DATE()")
            ->orWhere("CURRENT_DATE() <= DATE_ADD(m.createdAt, m.expiration, 'day') AND m.createdAt <= CURRENT_DATE()")
            ->setParameter('device', $device)
            ->getQuery()->execute();

    }

}