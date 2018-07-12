<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactRequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Contactrequest controller.
 *
 * @Route("contactrequest")
 */
class ContactRequestController extends Controller
{
    /**
     * Lists all contactRequest entities.
     *
     * @Route("/", name="contactrequest_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contactRequests = $em->getRepository('AppBundle:ContactRequest')->findAll();

        return $this->render('contactrequest/index.html.twig', array(
            'contactRequests' => $contactRequests,
        ));
    }

    /**
     * Creates a new contactRequest entity.
     *
     * @Route("/new", name="contactrequest_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $contactRequest = new Contactrequest();
        $form = $this->createForm('AppBundle\Form\ContactRequestType', $contactRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactRequest);
            $em->flush();

            return $this->redirectToRoute('contactrequest_show', array('id' => $contactRequest->getId()));
        }

        return $this->render('contactrequest/new.html.twig', array(
            'contactRequest' => $contactRequest,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contactRequest entity.
     *
     * @Route("/{id}", name="contactrequest_show")
     * @Method("GET")
     */
    public function showAction(ContactRequest $contactRequest)
    {
        $deleteForm = $this->createDeleteForm($contactRequest);

        return $this->render('contactrequest/show.html.twig', array(
            'contactRequest' => $contactRequest,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contactRequest entity.
     *
     * @Route("/{id}/edit", name="contactrequest_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ContactRequest $contactRequest)
    {
        $deleteForm = $this->createDeleteForm($contactRequest);
        $editForm = $this->createForm('AppBundle\Form\ContactRequestType', $contactRequest);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contactrequest_edit', array('id' => $contactRequest->getId()));
        }

        return $this->render('contactrequest/edit.html.twig', array(
            'contactRequest' => $contactRequest,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a contactRequest entity.
     *
     * @Route("/{id}", name="contactrequest_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ContactRequest $contactRequest)
    {
        $form = $this->createDeleteForm($contactRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contactRequest);
            $em->flush();
        }

        return $this->redirectToRoute('contactrequest_index');
    }

    /**
     * Creates a form to delete a contactRequest entity.
     *
     * @param ContactRequest $contactRequest The contactRequest entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ContactRequest $contactRequest)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contactrequest_delete', array('id' => $contactRequest->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
