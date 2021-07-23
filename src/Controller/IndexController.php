<?php

namespace App\Controller;

use App\Entity\Ambulance;
use App\Entity\Report;
use App\Entity\Tourism;
use App\Entity\User;
use App\Repository\ReportRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'IndexController','users'=>$user
        ]);

    }

    /**
     * @Route("/profilepic", name="profile")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function create(Request $request, UserRepository $userRepository){

        $user = $userRepository->findAll();
        $id = $this->getUser()->getID();
        $form =$this->createFormBuilder()
            ->add('image',FileType::class, [
                'label'=>'new Image',
                'attr'=>[
                    'class'=>'form-control',
                ]
            ])
            ->add('Submit', SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary mr-2'
                ]
            ])->
            getForm()
        ;


        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $data = $form->getData();
//            $user = new User();


            $em = $this->getDoctrine()->getManager();
            /**
             * @var UploadedFile $file
             */
            $file = $request->files->get('form')['image'];
            if ($file) {
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();

                $file->move(
                    $this->getParameter('uploads_dir'),
                    $filename
                );
                $pic = $em->getRepository(User::class)->find($id);
                $pic->setImage($filename);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('index'));
        }


        //$em->persist($user);
        //$em->flush();

        return $this->render('profile/upadate.html.twig',
            ['form' => $form->createView(), 'users'=>$user]);
    }

    /**
     * @Route("/status", name="status")
     */
    public function stat(ReportRepository $reportRepository, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('report/report.html.twig', [
            'reports' => $reportRepository->findAll(),
            'users'=>$user,
        ]);
    }
    #[Route('/report{id}', name: 'report_show', methods: ['GET'])]
    public function show(Report $report, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('report/show.html.twig', [
            'report' => $report,
            'users'=>$user,
        ]);
    }
}
