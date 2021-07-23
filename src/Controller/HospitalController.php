<?php

namespace App\Controller;

use App\Entity\Hospital;
use App\Form\HospitalType;
use App\Repository\HospitalRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class HospitalController extends AbstractController
{
    #[Route('/hospital', name: 'hospital_index', methods: ['GET'])]
    public function index(HospitalRepository $hospitalRepository, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('hospital/index.html.twig', [
            'hospitals' => $hospitalRepository->findAll(),
            'users'=>$user,
        ]);
    }

    #[Route('/hospitalnew', name: 'hospital_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        $hospital = new Hospital();
        $form = $this->createForm(HospitalType::class, $hospital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hospital);
            $entityManager->flush();

            return $this->redirectToRoute('hospital_index');
        }

        return $this->render('hospital/new.html.twig', [
            'hospital' => $hospital,
            'form' => $form->createView(),
            'users'=>$user,
        ]);
    }

    #[Route('/hospital{id}', name: 'hospital_show', methods: ['GET'])]
    public function show(Hospital $hospital, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('hospital/show.html.twig', [
            'hospital' => $hospital,
            'users'=>$user,
        ]);
    }

    #[Route('/edithospital{id}', name: 'hospital_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hospital $hospital, UserRepository $userRepository): Response
    {

        $user = $userRepository->findAll();
        $form = $this->createForm(HospitalType::class, $hospital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hospital_index');
        }

        return $this->render('hospital/edit.html.twig', [
            'hospital' => $hospital,
            'form' => $form->createView(),
            'users'=>$user,
        ]);
    }

    #[Route('/hospital{id}', name: 'hospital_delete', methods: ['POST'])]
    public function delete(Request $request, Hospital $hospital): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hospital->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hospital);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hospital_index');
    }
}
