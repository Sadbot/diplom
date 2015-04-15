<?php

namespace Sadbot\Bundle\VideoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AudioRepository extends EntityRepository{

    public function findOnePathById($id)
    {
        return $this->getEntityManager()
        ->createQuery('
            SELECT p.path
            FROM SadbotVideoBundle:Audio p
             WHERE p.id = :id
        ')
            ->setParameter('id',$id)
            ->getSingleResult();

    }

}