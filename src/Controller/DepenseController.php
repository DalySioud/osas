<?php

namespace App\Controller;

use App\Entity\Depense;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DepenseRepository;
use App\Form\DepenseType;
use App\Service\ConversionService;


#[Route('/depense')]
class DepenseController extends AbstractController
{
    #[Route('/', name: 'app_depense_index', methods: ['GET'])]
    public function index(DepenseRepository $depenseRepository, ConversionService $conversionService): Response
    {
        // Get the conversion rate
        $conversionRate = $conversionService->getDollarToDinarConversionRate();

        // Fetch all depenses
        $depenses = $depenseRepository->findAll();

        // Calculate the "Prix en Dinar" for each depense and store it in a new array
        $depensesWithPrixEnDinar = [];
        foreach ($depenses as $depense) {
            $depense->prixEnDinar = (int) round(($depense->getPrix() ?? 0) * $conversionRate);
            $depensesWithPrixEnDinar[] = $depense;
        }

        return $this->render('depense/index.html.twig', [
            'depenses' => $depensesWithPrixEnDinar,
        ]);
    }

    #[Route('/new', name: 'app_depense_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConversionService $conversionService): Response
    {
        $depense = new Depense();
        
        // Automatically set the date_ajout value before persisting
        $depense->setDateAjout(new \DateTimeImmutable());

        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depense);
            $entityManager->flush();

            return $this->redirectToRoute('app_depense_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depense/new.html.twig', [
            'depense' => $depense,
            'form' => $form,
        ]);
    }

    
    
    #[Route('/{id}/edit', name: 'app_depense_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Depense $depense, DepenseRepository $depenseRepository): Response
    {
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $depenseRepository->save($depense, true);

            return $this->redirectToRoute('app_depense_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depense/edit.html.twig', [
            'depense' => $depense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depense_delete', methods: ['POST'])]
    public function delete(Request $request, Depense $depense, DepenseRepository $depenseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depense->getId(), $request->request->get('_token'))) {
            $depenseRepository->remove($depense, true);
        }

        return $this->redirectToRoute('app_depense_index', [], Response::HTTP_SEE_OTHER);
    }


}