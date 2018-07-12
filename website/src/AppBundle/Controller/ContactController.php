<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactRequest;
use AppBundle\FormType\ContactRequestType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact_add_new_contact_request")
     */
    public function addNewContactRequestAction(Request $request)
    {
        $contactRequest = new ContactRequest();

        $contactForm = $this->createForm(
            ContactRequestType::class,
            $contactRequest,
            ['action' => $this->generateUrl('contact_add_new_contact_request', ['id'=>$contactRequest->getId()])]
        );

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $this->get('app_contact_request_manager')
                ->persistContactRequest($contactRequest);

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('contact/form.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }

    /**
     * @Route("/edit-contact/{id}", name="contact_edit_contact_request")
     */
    public function editContactRequestAction(Request $request, ContactRequest $contactRequest)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $contactForm = $this->createContactRequestForm($contactRequest);

        $contactForm->handleRequest($request);

        if($contactForm->isSubmitted() && $contactForm->isValid()) {
            $entityManager->flush();
        }

        return $this->render('contact/form.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }

    /**
     * @Route("/delete-contact/{id}")
     */
    public function deleteContactRequest(ContactRequest $contactRequest)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($contactRequest);
        $entityManager->flush();

        return $this->redirectToRoute('app_homepage');
    }
}
