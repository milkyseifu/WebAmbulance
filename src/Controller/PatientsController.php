<?php

namespace App\Controller;

use App\Entity\Ambulance;
use App\Entity\Patients;
use App\Form\PatientsType;
use App\Repository\PatientsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class PatientsController extends AbstractController
{
    #[Route('/patients', name: 'patients_index', methods: ['GET'])]
    public function index(PatientsRepository $patientsRepository, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('patients/index.html.twig', [
            'patients' => $patientsRepository->findAll(),
            'users'=>$user,
        ]);
    }

    #[Route('/patientnew', name: 'patients_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        $patient = new Patients();
        $form = $this->createForm(PatientsType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->flush();

            return $this->redirectToRoute('patients_index');
        }

        return $this->render('patients/new.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
            'users'=>$user
        ]);
    }

    #[Route('/patient{id}', name: 'patients_show', methods: ['GET'])]
    public function show(Patients $patient, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('patients/show.html.twig', [
            'patient' => $patient,
            'users'=>$user
        ]);
    }

    #[Route('/editpatient{id}', name: 'patients_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Patients $patient, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        $form = $this->createForm(PatientsType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patients_index');
        }

        return $this->render('patients/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
            'users'=>$user
        ]);
    }

    #[Route('/patient{id}', name: 'patients_delete', methods: ['POST'])]
    public function delete(Request $request, Patients $patient, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patients_index');
    }
}