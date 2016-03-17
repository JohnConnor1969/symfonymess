<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\AST\Functions;
use Doctrine\DBAL\Platforms;

class DeviceRepository extends EntityRepository
{
    /**
     * @param GroupOf $groupOf
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getDeviceFromG(GroupOf $groupOf)
    {
        return $this->createQueryBuilder('d')
            ->andWhere("d.groupOf = :groupof")
            ->setParameter('groupof', $groupOf)
            ->getQuery()->execute();
    }

    /**
     * @param Message $viewed
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getDeviceFromM(Message $viewed)
    {
        return $this->createQueryBuilder('d')
            ->andWhere("d.viewedMessages = :viewed")
            ->setParameter('viewed', $viewed)
            ->getQuery()->execute();
    }
}