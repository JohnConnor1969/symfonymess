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
            ->join('AppBundle:Device', 'd', 'WITH', 'd.id = :device')
            ->join('d.groups', 'gg', 'WITH', 'gg.id = m.group')
//            ->join('d.messages', 'dm', 'WITH', 'dm.id = m.id')

//            ->andWhere("CURRENT_DATE() <= DATE_ADD(m.date, m.expiration, 'day') AND m.date <= CURRENT_DATE()")
//            ->orWhere("CURRENT_DATE() <= DATE_ADD(m.createdAt, m.expiration, 'day') AND m.createdAt <= CURRENT_DATE()")
            ->setParameter('device', $device)
            ->getQuery()->execute();

    }
}