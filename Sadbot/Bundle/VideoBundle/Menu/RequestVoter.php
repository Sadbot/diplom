<?php
/**
 * Created by PhpStorm.
 * User: semse_000
 * Date: 03.06.2015
 * Time: 15:17
 */

namespace Sadbot\Bundle\VideoBundle\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Voter\VoterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RequestVoter implements VoterInterface{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function matchItem(ItemInterface $item)
    {
        if ($item->getUri() === $this->container->get('request')->getRequestUri()) {
            // URL's completely match
            return true;
        } else if($item->getUri() !== $this->container->get('request')->getBaseUrl().'/' && (substr($this->container->get('request')->getRequestUri(), 0, strlen($item->getUri())) === $item->getUri())) {
            // URL isn't just "/" and the first part of the URL match
            return true;
        }
        return null;
    }
}