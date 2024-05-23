<?php

namespace App\Controller;

use App\Entity\Streamdemain;
use App\Form\Streamdemain1Type;
use App\Repository\StreamdemainRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/streamdemain')]
class StreamdemainController extends AbstractController
{
    #[Route('/', name: 'app_streamdemain_index', methods: ['GET'])]
    public function index(StreamdemainRepository $streamdemainRepository): Response
    {
        return $this->render('streamdemain/index.html.twig', [
            'streamdemains' => $streamdemainRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_streamdemain_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $streamdemain = new Streamdemain();
        $form = $this->createForm(Streamdemain1Type::class, $streamdemain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($streamdemain);
            $entityManager->flush();

            return $this->redirectToRoute('app_streamdemain_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('streamdemain/new.html.twig', [
            'streamdemain' => $streamdemain,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_streamdemain_show', methods: ['GET'])]
    public function show(Streamdemain $streamdemain): Response
    {
        return $this->render('streamdemain/show.html.twig', [
            'streamdemain' => $streamdemain,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_streamdemain_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Streamdemain $streamdemain, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Streamdemain1Type::class, $streamdemain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_streamdemain_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('streamdemain/edit.html.twig', [
            'streamdemain' => $streamdemain,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_streamdemain_delete', methods: ['POST'])]
    public function delete(Request $request, Streamdemain $streamdemain, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$streamdemain->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($streamdemain);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_streamdemain_index', [], Response::HTTP_SEE_OTHER);
    }
}
