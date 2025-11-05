<?php

namespace App\Controller;

use App\Entity\Cliente\Cliente;
use App\Form\ClienteType;
use App\Repository\ClienteRepository;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cliente")
 */
class ClienteController extends AbstractController
{
    /**
     * @Route("/", name="cliente_index", methods={"GET"})
     */
    public function index(ClienteRepository $clienteRepository): Response
    {
        return $this->render('cliente/index.html.twig', [
            'clientes' => $clienteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cliente_new", methods={"GET", "POST"})
     * @throws Exception
     */
    public function new(Request $request, ClienteRepository $clienteRepository): Response
    {
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        dump(date('Y-m-d H:i:s'));

        if ($form->isSubmitted() && $form->isValid()) {
            $dataAtual = new DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
            $cliente->setDataCadastro($dataAtual);
            dump($cliente->getDataCadastro());
            $clienteRepository->add($cliente);
            return $this->redirectToRoute('cliente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cliente/new.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cliente_show", methods={"GET"})
     */
    public function show(Cliente $cliente): Response
    {
        return $this->render('cliente/show.html.twig', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cliente_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Cliente $cliente, ClienteRepository $clienteRepository): Response
    {
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clienteRepository->add($cliente);
            return $this->redirectToRoute('cliente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cliente/edit.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cliente_delete", methods={"POST"})
     */
    public function delete(Request $request, Cliente $cliente, ClienteRepository $clienteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cliente->getId(), $request->request->get('_token'))) {
            $clienteRepository->remove($cliente);
        }

        return $this->redirectToRoute('cliente_index', [], Response::HTTP_SEE_OTHER);
    }
}
