<?php

namespace App\Controller;

use App\Entity\Drivers;
use App\Entity\User;
use App\Repository\AmbulanceRepository;
use App\Repository\DriversRepository;
use App\Repository\HospitalRepository;
use App\Repository\IncidentInfoRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/secure.html.twig',
            ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(UserRepository $userRepository, AmbulanceRepository $ambulanceRepository, HospitalRepository $hospitalRepository, DriversRepository $driversRepository, IncidentInfoRepository $incidentInfoRepository){
        $user = $userRepository->findAll();
        $ambulance = count($ambulanceRepository->findAll());
        $hospital = count($hospitalRepository->findAll());
        $driver = count($driversRepository->findAll());
        $incidentInfo = count($incidentInfoRepository->findAll());
        $st = new \DateTime('now');
        $start = $st->format('Y/m/d');
        return $this->render('security/dashboard.html.twig',[
            'users'=>$user,
            'starts'=>$start,
            'drivers'=>$driver,
            'ambulances'=>$ambulance,
            'hospitals'=>$hospital,
            'incidents'=>$incidentInfo
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

//    /**
//     * @Route("/userReg", name="usereg")
//     */
//    public function creates(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, UserRepository $userRepository): Response
//    {
//        $users = $userRepository->findAll();
//        $form =$this->createFormBuilder()
//            ->add('email', TextType::class, [
//                'label'=>'E-mail',
//                'attr'=>[
//                    'class'=>'form-control'
//                ]
//
//            ])
//            ->add('password', RepeatedType::class, [
//                'type'=>PasswordType::class,
//                'required'=>true,
//                'first_options'=>['label'=>'Password', 'attr'=>[
//                    'class'=>'form-control'
//                ]],
//                'second_options'=>['label'=>'Confirm Password', 'attr'=>[
//                    'class'=>'form-control'
//                ]],
//
//            ])
//
//            ->add('image',FileType::class, [
//                'label'=>'Image',
//                'attr'=>[
//                    'class'=>'form-control',
//                ]
//            ])
//            ->add('Submit', SubmitType::class,[
//                'attr'=>[
//                    'class'=>'btn btn-primary mr-2'
//                ]
//            ])
//            ->getForm();
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted()){
//
//            $data =$form->getData();
//
//            $user = new User();
//            $user->setEmail($data['email']);
//            $user->setPassword($userPasswordEncoder->encodePassword($user, $data['password']));
//
//            $em = $this->getDoctrine()->getManager();
//            /**
//             * @var UploadedFile $file
//             */
//            $file = $request->files->get('form')['image'];
//            if ($file) {
//                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
//
//                $file->move(
//                    $this->getParameter('uploads_dir'),
//                    $filename
//                );
//                $user->setImage($filename);
//            }
//
//            $em->persist($user);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('index'));
//        }
//
//
//        //$em->persist($user);
//        //$em->flush();
//
//        return $this->render('index/user.html.twig',
//            ['form' => $form->createView(), 'users'=>$users]);
//        }



}