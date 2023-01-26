<?php

namespace App\Controller;

use App\Controller\Admin\PreRegistrationCrudController;
use App\Entity\PreRegistration;
use App\Form\PreRegistrationType;
use App\Repository\AppOptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\Registry;
use App\Repository\PreRegistrationRepository;
use App\Service\Printer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use Symfony\Component\Workflow\Exception\LogicException;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/pre/registration')]
class PreRegistrationController extends AbstractController
{
    public function __construct(private Registry $registry, private AdminUrlGenerator $adminUrlGenerator, private Printer $printer)
    {
    }

    #[Route('/', name: 'app_pre_registration_index', methods: ['GET'])]
    public function index(PreRegistrationRepository $preRegistrationRepository): Response
    {
        return $this->render('pre_registration/index.html.twig', [
            'pre_registrations' => $preRegistrationRepository->findAll(),
        ]);
    }

    #[Route('/preinscription-approuvees', name: 'app_pre_registration_approuved', methods: ['GET'])]
    public function approuved(PreRegistrationRepository $preRegistrationRepository, AppOptionRepository $appOptionRepository): Response
    {
        $html = $this->render('pre_registration/approuved.html.twig', [
            'pre_registrations' => $preRegistrationRepository->findBy(['status' => 'Validée']),
            'options' => $appOptionRepository->findAll()[0],
        ]);

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $fichier = 'liste_des_etudiants_selectionnes.pdf';

        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);

        return new Response();


    }

    

    #[Route('/new', name: 'app_pre_registration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PreRegistrationRepository $preRegistrationRepository, AppOptionRepository $appOptionRepository): Response
    {
        $appOptions = $appOptionRepository->findAll()[0];

        $preRegistration = new PreRegistration();
        $form = $this->createForm(PreRegistrationType::class, $preRegistration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $preRegistration->setStatus('Créée');

            try {
                $workflow = $this->registry->get($preRegistration, 'pre_registration_process');
                $workflow->apply($preRegistration, 'to_validation_pending');
            } catch (LogicException $e) {
                echo $e->getMessage();
            }
            try {
                $preRegistration->setAcademicYear($appOptions->getCurrentAcademicYear());    
            } catch (\Throwable $th) {
                throw $th;
            }

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

    #[Route('/{id}/{to}', name: 'pre_registration_change_status')]
    public function changeStatus(Request $request, string $to, PreRegistration $preRegistration, EntityManagerInterface $entityManager): Response
    {
        $workflow = $this->registry->get($preRegistration, 'pre_registration_process');

        try {
            $workflow->apply($preRegistration, $to);
        } catch (LogicException $e) {
            echo $e->getMessage();
        }

        $entityManager->persist($preRegistration);
        $entityManager->flush();

        $url = $this->adminUrlGenerator
            ->setController(PreRegistrationCrudController::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        return $this->redirect($url);
    }
}
