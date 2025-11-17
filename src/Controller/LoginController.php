<?php

namespace App\Controller;

use App\Repository\ClienteRepository;
use App\Repository\LocalRepository;
use App\Repository\Maquina\ModeloRepository;
use App\Repository\Maquina\MaquinaRepository;
use App\Repository\Checklist\ChecklistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
//    /**
//     * @Route("/login", name="app_login")
//     */
//    public function index(): Response
//    {
//        return $this->render('login/index.html.twig', [
//            'controller_name' => 'LoginController',
//        ]);
//    }

    /**
     * @Route("/dashboard", name="app_dashboard", methods={"GET", "POST"})
     */
    public function dashboard(
        ClienteRepository $clienteRepository,
        LocalRepository $localRepository,
        ModeloRepository $modeloRepository,
        MaquinaRepository $maquinaRepository,
        ChecklistRepository $checklistRepository
    ): Response
    {
        $usuario = $this->getUser();
        dump($usuario);

        return $this->render('dashboard/index.html.twig', [
            'clientes' => $clienteRepository->findAll(),
            'locais' => $localRepository->findAll(),
            'modelos' => $modeloRepository->findAll(),
            'maquinas' => $maquinaRepository->findAll(),
            'checklists' => $checklistRepository->findAll()
        ]);
    }






}
