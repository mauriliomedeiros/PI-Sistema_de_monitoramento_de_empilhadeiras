<?php

namespace App\Controller;

use App\Repository\ClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    /**
     * @Route("/dashboard", name="app_dashboard", methods={"GET", "POST"})
     */
    public function dashboard(ClienteRepository $clienteRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'clientes' => $clienteRepository->findAll(),
        ]);
    }






}
