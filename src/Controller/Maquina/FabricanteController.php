<?php

namespace App\Controller\Maquina;

use App\Entity\Maquina\Fabricante;
use App\Form\Maquina\FabricanteType;
use App\Repository\Maquina\FabricanteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maquina/fabricante")
 */
class FabricanteController extends AbstractController
{
    /**
     * @Route("/", name="app_maquina_fabricante_index", methods={"GET"})
     */
    public function index(FabricanteRepository $fabricanteRepository): Response
    {
        return $this->render('maquina/fabricante/index.html.twig', [
            'fabricantes' => $fabricanteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_maquina_fabricante_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FabricanteRepository $fabricanteRepository): Response
    {
        $fabricante = new Fabricante();
        $form = $this->createForm(FabricanteType::class, $fabricante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fabricanteRepository->add($fabricante);
            return $this->redirectToRoute('app_maquina_fabricante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('maquina/fabricante/new.html.twig', [
            'fabricante' => $fabricante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_maquina_fabricante_show", methods={"GET"})
     */
    public function show(Fabricante $fabricante): Response
    {
        return $this->render('maquina/fabricante/show.html.twig', [
            'fabricante' => $fabricante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_maquina_fabricante_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Fabricante $fabricante, FabricanteRepository $fabricanteRepository): Response
    {
        $form = $this->createForm(FabricanteType::class, $fabricante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fabricanteRepository->add($fabricante);
            return $this->redirectToRoute('app_maquina_fabricante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('maquina/fabricante/edit.html.twig', [
            'fabricante' => $fabricante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_maquina_fabricante_delete", methods={"POST"})
     */
    public function delete(Request $request, Fabricante $fabricante, FabricanteRepository $fabricanteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fabricante->getId(), $request->request->get('_token'))) {
            $fabricanteRepository->remove($fabricante);
        }

        return $this->redirectToRoute('app_maquina_fabricante_index', [], Response::HTTP_SEE_OTHER);
    }
}
