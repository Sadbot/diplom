<?php

namespace Sadbot\Bundle\VideoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PhotoRepository extends EntityRepository{

    public function findOneById($id)
    {
        return $this->getEntityManager()
        ->createQuery('
            SELECT p.path
            FROM SadbotVideoBundle:Photo p
             WHERE p.id = :id
        ')
            ->setParameter('id',$id)
            ->getSingleResult();

    }

}