<?php

namespace App\Controller\Checklist;

use App\Entity\Checklist\Checklist;
use App\Form\Checklist\ChecklistType;
use App\Repository\Checklist\ChecklistRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/checklist", name="checklist_")
 */
class ChecklistController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ChecklistRepository $checklistRepository): Response
    {
        return $this->render('checklist/checklist/index.html.twig', [
            'checklists' => $checklistRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, ChecklistRepository $checklistRepository): Response
    {
        $checklist = new Checklist();
        $form = $this->createForm(ChecklistType::class, $checklist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dataAtual = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
            $checklist->setDataHoraRealizado($dataAtual);
            $checklistRepository->add($checklist);
            return $this->redirectToRoute('checklist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('checklist/checklist/new.html.twig', [
            'checklist' => $checklist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Checklist $checklist): Response
    {
        return $this->render('checklist/checklist/show.html.twig', [
            'checklist' => $checklist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Checklist $checklist, ChecklistRepository $checklistRepository): Response
    {
        $form = $this->createForm(ChecklistType::class, $checklist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $checklistRepository->add($checklist);
            return $this->redirectToRoute('checklist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('checklist/checklist/edit.html.twig', [
            'checklist' => $checklist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Checklist $checklist, ChecklistRepository $checklistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$checklist->getId(), $request->request->get('_token'))) {
            $checklistRepository->remove($checklist);
        }

        return $this->redirectToRoute('checklist_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/alterar/status/{id}", name="alterar_status", methods={"GET", "POST"})
     */
    public function alterarStatus(Checklist $checklist, EntityManagerInterface $em): Response
    {
        if ($checklist != '' and $checklist->getId()) {
            if ($checklist->getAtivo()) {
                $checklist->setAtivo(false);
            } else {
                $checklist->setAtivo(true);
            }
            $em->persist($checklist);
            $em->flush();
        }
        return $this->redirectToRoute('checklist_index', [], Response::HTTP_SEE_OTHER);
    }
}
