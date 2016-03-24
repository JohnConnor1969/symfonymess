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
    public function getMessagesForDevice (Device $device)
    {
        return $this->createQueryBuilder('m')

            ;
    }
}