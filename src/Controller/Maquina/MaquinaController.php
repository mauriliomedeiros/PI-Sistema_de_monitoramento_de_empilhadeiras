<?php

namespace App\Controller\Maquina;

use App\Entity\Maquina\Maquina;
use App\Form\Maquina\MaquinaType;
use App\Repository\Maquina\MaquinaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maquina", name="maquina_")
 */
class MaquinaController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(MaquinaRepository $maquinaRepository): Response
    {
        return $this->render('maquina/maquina/index.html.twig', [
            'maquinas' => $maquinaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, MaquinaRepository $maquinaRepository): Response
    {
        $maquina = new Maquina();
        $form = $this->createForm(MaquinaType::class, $maquina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maquinaRepository->add($maquina);
            return $this->redirectToRoute('maquina_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('maquina/maquina/new.html.twig', [
            'maquina' => $maquina,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Maquina $maquina): Response
    {
        return $this->render('maquina/maquina/show.html.twig', [
            'maquina' => $maquina,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Maquina $maquina, MaquinaRepository $maquinaRepository): Response
    {
        $form = $this->createForm(MaquinaType::class, $maquina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maquinaRepository->add($maquina);
            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('maquina/maquina/edit.html.twig', [
            'maquina' => $maquina,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Maquina $maquina, MaquinaRepository $maquinaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maquina->getId(), $request->request->get('_token'))) {
            $maquinaRepository->remove($maquina);
        }

        return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
    }
}
