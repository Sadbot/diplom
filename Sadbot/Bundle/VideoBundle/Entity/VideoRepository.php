<?php

namespace Sadbot\Bundle\VideoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class VideoRepository extends EntityRepository{

    public function findOnePathById($id)
    {
        return $this->getEntityManager()
            ->createQuery('
            SELECT p.path
            FROM SadbotVideoBundle:Video p
             WHERE p.id = :id
        ')
            ->setParameter('id',$id)
            ->getSingleResult();

    }

}