<?php

namespace Sadbot\Bundle\VideoBundle\Controller;

use Sadbot\Bundle\VideoBundle\Entity\Video;
use Sadbot\Bundle\VideoBundle\Form\Type\VideoUploadType;
use Sadbot\Bundle\VideoBundle\SadbotVideoBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $video = $em->getRepository('SadbotVideoBundle:Video')
            ->findLast10Video();

        return $this->render('SadbotVideoBundle:Default:index.html.twig', array('result' => $video));
    }

    public function uploadAction(Request $request)
    {
        $video = new Video();

        $uploadForm = $this->createForm(new VideoUploadType(), $video);

        $uploadForm->handleRequest($request);

        if ($uploadForm->isValid()){

            $user = $this->container->get('security.context')->getToken()->getUser();

            $video->setAuthor($user);

            $em = $this->getDoctrine()->getManager();

            $video->upload();

            $em->persist($video);
            $em->flush();

            return $this->redirect($this->generateUrl('_video_homepage'));
        }

        return $this->render('SadbotVideoBundle:FileUpload:uploadform.html.twig', array(
            'uploadform' => $uploadForm->createView()
        ));
    }


    public function watchVideoAction($id){

        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('SadbotVideoBundle:Video')
            ->findOneById($id);

        return $this->render('SadbotVideoBundle:Watch:watch.html.twig',array(
            'video' => $video
        ));
    }
}
