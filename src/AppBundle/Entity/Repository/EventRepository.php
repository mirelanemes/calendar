<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{
    public function createFindAllQuery()
    {
        return $this->_em->createQuery(
            "
            SELECT e
            FROM AppBundle:Event e
            "
        );
    }


    public function createFindOneByIdQuery($id)
    {
        $query = $this->_em->createQuery(
            "
            SELECT e
            FROM AppBundle:Event e
            WHERE e.id = :id
            "
        );

        $query->setParameter('id', $id);

        return $query;
    }
}