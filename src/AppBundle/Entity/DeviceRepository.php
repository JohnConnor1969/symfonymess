<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\AST\Functions;
use Doctrine\DBAL\Platforms;

class DeviceRepository extends EntityRepository
{
    /**
     * @param Group $group
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getDeviceFromG(Group $group)
    {
        return $this->createQueryBuilder('d')
            ->andWhere("d.group = :group")
            ->setParameter('group', $group)
            ->getQuery()->execute();
    }

    /**
     * @param Message $viewed
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getDeviceFromM(Message $viewed)
    {
        return $this->createQueryBuilder('d')
            ->andWhere("d.messages = :viewed")
            ->setParameter('viewed', $viewed)
            ->getQuery()->execute();
    }
}