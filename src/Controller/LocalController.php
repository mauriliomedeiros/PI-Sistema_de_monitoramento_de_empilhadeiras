<?php

namespace App\Controller;

use App\Entity\Local\Local;
use App\Form\LocalType;
use App\Repository\LocalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/local")
 */
class LocalController extends AbstractController
{
    /**
     * @Route("/", name="local_index", methods={"GET"})
     */
    public function index(LocalRepository $localRepository): Response
    {
        return $this->render('local/index.html.twig', [
            'locais' => $localRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="local_new", methods={"GET", "POST"})
     */
    public function new(Request $request, LocalRepository $localRepository): Response
    {
        $local = new Local();
        $form = $this->createForm(LocalType::class, $local);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $localRepository->add($local);
            return $this->redirectToRoute('local_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('local/new.html.twig', [
            'local' => $local,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="local_show", methods={"GET"})
     */
    public function show(Local $local): Response
    {
        return $this->render('local/show.html.twig', [
            'local' => $local,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="local_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Local $local, LocalRepository $localRepository): Response
    {
        $form = $this->createForm(LocalType::class, $local);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $localRepository->add($local);
            return $this->redirectToRoute('local_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('local/edit.html.twig', [
            'local' => $local,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="local_delete", methods={"POST"})
     */
    public function delete(Request $request, Local $local, LocalRepository $localRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$local->getId(), $request->request->get('_token'))) {
            $localRepository->remove($local);
        }

        return $this->redirectToRoute('local_index', [], Response::HTTP_SEE_OTHER);
    }
}
