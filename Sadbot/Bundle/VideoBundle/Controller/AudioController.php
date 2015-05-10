<?php

namespace Sadbot\Bundle\VideoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sadbot\Bundle\VideoBundle\Entity\Audio;
use Sadbot\Bundle\VideoBundle\Form\AudioType;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Audio controller.
 *
 */
class AudioController extends Controller
{

    /**
     * Lists all Audio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SadbotVideoBundle:Audio')->findAll();

        return $this->render('SadbotVideoBundle:Audio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Audio entity.
     *
     */
    public function createAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $entity = new Audio();

        if ($this->getUser()) {
            $entity->setAuthor($this->getUser());
        }

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_audio_show', array('id' => $entity->getId())));
        }

        return $this->render('SadbotVideoBundle:Audio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Audio entity.
     *
     * @param Audio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Audio $entity)
    {
        $form = $this->createForm(new AudioType(), $entity, array(
            'action' => $this->generateUrl('_audio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Audio entity.
     *
     */
    public function uploadAction()
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $entity = new Audio();
        $form   = $this->createCreateForm($entity);

        return $this->render('SadbotVideoBundle:Audio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Audio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SadbotVideoBundle:Audio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Audio entity.');
        }

        $path = 'uploads/audios/'.$entity->getPath();

        $file = new File($path);

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SadbotVideoBundle:Audio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'path'        => $path,
            'mimeType'    => $file->getMimeType()
        ));
    }

    /**
     * Displays a form to edit an existing Audio entity.
     *
     */
    public function editAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SadbotVideoBundle:Audio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Audio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SadbotVideoBundle:Audio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Audio entity.
    *
    * @param Audio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Audio $entity)
    {
        $form = $this->createForm(new AudioType(), $entity, array(
            'action' => $this->generateUrl('_audio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Audio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SadbotVideoBundle:Audio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Audio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_audio_edit', array('id' => $id)));
        }

        return $this->render('SadbotVideoBundle:Audio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Audio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SadbotVideoBundle:Audio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Audio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('_audio'));
    }

    /**
     * Creates a form to delete a Audio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_audio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function downloadAction($id)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('SadbotVideoBundle:Audio');

        $entity = $em->findOnePathById($id);

        $filename = $entity['path'];

        $file = new File($this->get('kernel')->getRootDir().'/../web/uploads/audios/'.$filename);

        $response = new Response(file_get_contents($file->getPathname()));

        $newfilename = md5($file->getBasename()).'.'.$file->getExtension();

        $d = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $newfilename);
        $response->headers->set('Content-Disposition', $d);

        return $response;
    }

}
