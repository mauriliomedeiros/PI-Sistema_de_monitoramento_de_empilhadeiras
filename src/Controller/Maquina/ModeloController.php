<?php

namespace App\Controller\Maquina;

use App\Entity\Maquina\Modelo;
use App\Form\Maquina\ModeloType;
use App\Repository\Maquina\ModeloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maquina/modelo", name="maquina_modelo_")
 */
class ModeloController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ModeloRepository $modeloRepository): Response
    {
        dump('oi');
        try {
            dump('oi');
            $modelos = $modeloRepository->findAll();
        } catch (\Exception $e) {
            dump('oi');
            dump($e->getMessage(), $e->getTraceAsString());
        }

        dump('oi');
        return $this->render('maquina/modelo/index.html.twig', [
            'modelos' => $modelos,
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, ModeloRepository $modeloRepository): Response
    {
        $modelo = new Modelo();
        $form = $this->createForm(ModeloType::class, $modelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modeloRepository->add($modelo);
            return $this->redirectToRoute('maquina_modelo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('maquina/modelo/new.html.twig', [
            'modelo' => $modelo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show(Modelo $modelo): Response
    {
        return $this->render('maquina/modelo/show.html.twig', [
            'modelo' => $modelo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Modelo $modelo, ModeloRepository $modeloRepository): Response
    {
        $form = $this->createForm(ModeloType::class, $modelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modeloRepository->add($modelo);
            return $this->redirectToRoute('maquina_modelo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('maquina/modelo/edit.html.twig', [
            'modelo' => $modelo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Modelo $modelo, ModeloRepository $modeloRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modelo->getId(), $request->request->get('_token'))) {
            $modeloRepository->remove($modelo);
        }

        return $this->redirectToRoute('maquina_modelo_index', [], Response::HTTP_SEE_OTHER);
    }
}
