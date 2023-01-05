<?php

namespace App\Controller;

use App\Entity\PreRegistration;
use App\Form\PreRegistrationType;
use App\Repository\PreRegistrationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pre-registration')]
class PreRegistrationController extends AbstractController
{
    #[Route('/', name: 'app_pre_registration_index', methods: ['GET'])]
    public function index(PreRegistrationRepository $preRegistrationRepository): Response
    {
        return $this->render('pre_registration/index.html.twig', [
            'pre_registrations' => $preRegistrationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pre_registration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PreRegistrationRepository $preRegistrationRepository): Response
    {
        $preRegistration = new PreRegistration();
        $form = $this->createForm(PreRegistrationType::class, $preRegistration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($preRegistration, $form);
            
            $preRegistrationRepository->save($preRegistration, true);

            return $this->redirectToRoute('app_pre_registration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pre_registration/new.html.twig', [
            'pre_registration' => $preRegistration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pre_registration_show', methods: ['GET'])]
    public function show(PreRegistration $preRegistration): Response
    {
        return $this->render('pre_registration/show.html.twig', [
            'pre_registration' => $preRegistration,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pre_registration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PreRegistration $preRegistration, PreRegistrationRepository $preRegistrationRepository): Response
    {
        $form = $this->createForm(PreRegistrationType::class, $preRegistration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $preRegistrationRepository->save($preRegistration, true);

            return $this->redirectToRoute('app_pre_registration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pre_registration/edit.html.twig', [
            'pre_registration' => $preRegistration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pre_registration_delete', methods: ['POST'])]
    public function delete(Request $request, PreRegistration $preRegistration, PreRegistrationRepository $preRegistrationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$preRegistration->getId(), $request->request->get('_token'))) {
            $preRegistrationRepository->remove($preRegistration, true);
        }

        return $this->redirectToRoute('app_pre_registration_index', [], Response::HTTP_SEE_OTHER);
    }
}
