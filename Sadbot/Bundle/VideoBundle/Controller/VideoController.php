<?php

namespace Sadbot\Bundle\VideoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sadbot\Bundle\VideoBundle\Entity\Video;
use Sadbot\Bundle\VideoBundle\Form\VideoType;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Video controller.
 *
 * @Route("/")
 */
class VideoController extends Controller
{

    public function testAction(){

        $pheanstalk = $this->get('leezy.pheanstalk');

        $pheanstalk
            ->useTube('video_queue')
            ->put("Hi, world");
        $job = $pheanstalk
            ->watch('video')
            ->reserve();

        return new Response(var_dump($job));
    }

    /**
     * Lists all Video entities.
     *
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SadbotVideoBundle:Video')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Displays a form to create a new Video entity.
     *
     */
    public function uploadAction()
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $entity = new Video();
        $form   = $this->createCreateForm($entity);

        return $this->render('SadbotVideoBundle:Video:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Video entity.
     *
     * @Method("POST")
     * @Template("SadbotVideoBundle:Video:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $entity = new Video();

        if ($this->getUser()) {
            $entity->setAuthor($this->getUser());
        }

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_video_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Video entity.
     *
     * @param Video $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Video $entity)
    {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('_video_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a Video entity.
     *
     * @Route("/{id}", name="video_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SadbotVideoBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $path = 'uploads/videos/'.$entity->getPath();

        $file = new File($path);

        $deleteForm = $this->createDeleteForm($id);

        $mimeType = $file->getMimeType();

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'path' => $path,
            'mimeType' => $mimeType
        );
    }

    /**
     * Displays a form to edit an existing Video entity.
     *
     * @Route("/{id}/edit", name="video_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SadbotVideoBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Video entity.
    *
    * @param Video $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Video $entity)
    {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('_video_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Video entity.
     *
     * @Route("/{id}", name="video_update")
     * @Method("PUT")
     * @Template("SadbotVideoBundle:Video:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SadbotVideoBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_video_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Video entity.
     *
     * @Route("/{id}", name="video_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SadbotVideoBundle:Video')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Video entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('_video_homepage'));
    }

    /**
     * Creates a form to delete a Video entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_video_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function downloadAction($id)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('SadbotVideoBundle:Video');

        $entity = $em->findOnePathById($id);

        $filename = $entity['path'];

        $index = $this->renderView('SadbotVideoBundle:Video:download.html.twig');

        $file = new File($this->get('kernel')->getRootDir().'/../web/uploads/videos/'.$filename);

        $response = new Response(file_get_contents($file->getPathname()));

        $newfilename = md5($file->getBasename()).'.'.$file->getExtension();

        $d = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $newfilename);
        $response->headers->set('Content-Disposition', $d);

        return $response;
    }
}
