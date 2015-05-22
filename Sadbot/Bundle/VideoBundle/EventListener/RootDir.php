<?php

namespace Sadbot\VideoBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Sadbot\Bundle\VideoBundle\Entity\Photo;

class RootDir
{
    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Photo) {

        }
    }
}