<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DepenseRepository;

#[Route('/depense')]
class DepenseController extends AbstractController
{
    #[Route('/', name: 'app_depense_index', methods: ['GET'])]
    public function index(DepenseRepository $depenseRepository): Response
    {
        return $this->render('depense/index.html.twig', [
            'depenses' => $depenseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_depense_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DepenseRepository $depenseRepository): Response
    {
        $depense = new depense();
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $depenseRepository->save($depense, true);
   
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
}
