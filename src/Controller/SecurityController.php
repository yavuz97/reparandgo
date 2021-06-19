<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\MarqueRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class SecurityController extends AbstractController
{
    /**
     * @var \App\Entity\Marque[]
     */
    private array $marques;

    public function __construct(EntityManagerInterface $entityManager, MarqueRepository $marqueRepository)
    {
        $this->entityManager = $entityManager;
        $marques =  $marqueRepository->findAll();
        $this->marques = $marques;
    }


    /**
     * @Route("/security", name="security")
     */
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/user_add", name="security_user")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     */
    public function user_add(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $user->setRoles(["ROLE_USER"]);

            //on géénre le token d'activation
//            $user->setActivationToken(md5(uniqid()));
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'inscrit !'
            );


            return $this->redirectToRoute('security_login', ['marques' => $this->marques]);

        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            'marques' => $this->marques
        ]);
    }


    /**
     * @Route("/login", name="security_login")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils, UserRepository $userRepository)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        if ($error != null) {
            $verif = $userRepository->findOneBy(array('email' => $lastUsername));

            if ($verif == null) {
                $this->addFlash(
                    'danger',
                    "Non inscrit"."•".$lastUsername."•".$error->getMessage()
                );
            }else {
                $this->addFlash(
                    'danger',
                    "Mauvais identifiant ou mot de passe"
                );

            }

        }

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'marques' => $this->marques
        ));
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
        return $this->redirectToRoute('home',['marques' => $this->marques]);
    }






}
