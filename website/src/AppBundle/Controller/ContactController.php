<?php

namespace AppBundle\Controller;

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
        $formBuilder = $this->createFormBuilder(
            null,
            ['action' => $this->generateUrl('contact_add_new_contact_request')]
        );

        $contactForm = $formBuilder
            ->add('subject', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            // send an email

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('contact/form.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }
}
