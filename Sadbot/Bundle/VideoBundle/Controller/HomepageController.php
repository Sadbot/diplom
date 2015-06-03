<?php

namespace Sadbot\Bundle\VideoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sadbot\Bundle\VideoBundle\Entity\Video;
use Sadbot\Bundle\VideoBundle\Form\VideoType;

/**
 * Video controller.
 *
 * @Route("/")
 */
class HomepageController extends Controller
{


    public function indexAction()
    {
        return $this->render('SadbotVideoBundle:Homepage:index.html.twig');
    }

    public function testAction(){
        return $this->redirectToRoute('_homepage');


    }
}
