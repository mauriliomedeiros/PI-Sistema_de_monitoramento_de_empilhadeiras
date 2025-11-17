<?php

namespace App\Controller\Core;

use App\Entity\Core\Usuario;
use App\Form\Core\UsuarioType;
use App\Repository\Core\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/core/usuario", name="core_usuario_")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        return $this->render('core/usuario/index.html.twig', [
            'usuarios' => $usuarioRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        dump('caiu aqui');
        if ($form->isSubmitted() && $form->isValid()) {
            dump('caiu aqui');
            $senhaPura = $form->get('password')->getData();
            $senhaHash = $encoder->encodePassword($usuario, $senhaPura);
            $usuario->setPassword($senhaHash);

            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('core_usuario_index');
        }

        return $this->render('core/usuario/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Usuario $usuario): Response
    {
        return $this->render('core/usuario/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Usuario $usuario, UsuarioRepository $usuarioRepository): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usuarioRepository->add($usuario);
            return $this->redirectToRoute('core_usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('core/usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Usuario $usuario, UsuarioRepository $usuarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usuario->getId(), $request->request->get('_token'))) {
            $usuarioRepository->remove($usuario);
        }

        return $this->redirectToRoute('core_usuario_index', [], Response::HTTP_SEE_OTHER);
    }
}
