<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods:['GET', 'POST'])]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $email = (new Email())
                ->from(new Address($contact->getEmail(), $contact->getFullName()))
                ->to('secretariat.parcours-info.fst@umng.org')
                ->subject($contact->getObject())
                ->html($contact->getContent());
            try{
                $mailer->send($email);
                $this->addFlash('succes', 'Votre message a été envoyé avec succès');
            }catch(TransportExceptionInterface $e){
                dump($e->getMessage());
            }

            return $this->redirectToRoute('app_contact', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact/index.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }
}
