<?php

namespace Sadbot\Bundle\VideoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class VideoRepository extends EntityRepository{

    public function findLast10Video()
    {
        return $this->getManager()
            ->createQuery('SELECT v FROM SadbotVideoBundle:Video v ORDER BY v.id ASC')
            ->getResult();
    }

}