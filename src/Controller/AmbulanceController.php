<?php

namespace App\Controller;

use App\Entity\Ambulance;
use App\Form\AmbulanceType;
use App\Repository\AmbulanceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class AmbulanceController extends AbstractController
{
    #[Route('/ambulance', name: 'ambulance_index', methods: ['GET'])]
    public function index(AmbulanceRepository $ambulanceRepository, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('ambulance/index.html.twig', [
            'ambulances' => $ambulanceRepository->findAll(),
            'users'=>$user,
        ]);
    }

    #[Route('/ambulancenew', name: 'ambulance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        $ambulance = new Ambulance();
        $ambulance->setLatitude('0.0');
        $ambulance->setLongitude('0.0');
        $form = $this->createForm(AmbulanceType::class, $ambulance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ambulance);
            $entityManager->flush();

            return $this->redirectToRoute('ambulance_index');
        }

        return $this->render('ambulance/new.html.twig', [
            'ambulance' => $ambulance,
            'form' => $form->createView(),
            'users'=>$user,
        ]);
    }

    #[Route('/ambulance{id}', name: 'ambulance_show', methods: ['GET'])]
    public function show(Ambulance $ambulance, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('ambulance/show.html.twig', [
            'ambulance' => $ambulance,
            'users'=>$user,
        ]);
    }

    #[Route('/editambulance{id}', name: 'ambulance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ambulance $ambulance, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        $form = $this->createForm(AmbulanceType::class, $ambulance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ambulance_index');
        }

        return $this->render('ambulance/edit.html.twig', [
            'ambulance' => $ambulance,
            'form' => $form->createView(),
            'users'=>$user,
        ]);
    }

    #[Route('/ambulance/{id}', name: 'ambulance_delete', methods: ['POST'])]
    public function delete(Request $request, Ambulance $ambulance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ambulance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ambulance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ambulance_index');
    }
}