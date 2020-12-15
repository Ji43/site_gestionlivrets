<?php

namespace App\Controller;

use App\Entity\Livret;
use App\Form\LivretFormType;
use App\Repository\LivretRepository;
use App\Service\LivretNamerService;
use App\Service\usernamePasswordMakerService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LivretsController extends AbstractController
{
    /**
     * Permet d'afficher la liste des livrets en fonction du rôle
     *
     * @Route("/livrets", name="livrets")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, LivretRepository $repository, PaginatorInterface $paginator): Response
    {
        if($this->isGranted("ROLE_ADMIN")) {
            $donnees = $repository->findAll();

        }
        else {
            $donnees = $this->getUser()->getLivrets();
        }

        $livrets = $paginator->paginate(
            $donnees,$request->query->getInt('page',1),5
        );

        return $this->render('livrets/index.html.twig', [
            'livrets' => $livrets
         ]);
    }

    /**
     * Permet d'afficher la vue d'un livret
     *
     * @Route("/livrets/show/{id}", name="show_livret")
     * @isGranted("ROLE_USER")
     * @param Livret $livret
     * @return Response
     */
    public function view(Livret $livret) {

        return $this->render('livrets/view.html.twig',[
            'livret' => $livret
        ]);
    }

    /**
     * Permet la suppression d'un livret
     * @Route("/livrets/delete/{id}", name="delete_livret")
     * @isGranted("ROLE_ADMIN")
     *
     * @param Livret $livret
     * @param EntityManagerInterface $manager
     */
    public function delete(Livret $livret, EntityManagerInterface $manager) {

        $name = $livret->getNomLivret();
        $manager->remove($livret);
        $manager->flush();

        $this->addFlash("success","Le livret<strong> " . $name . "</strong> a bien été supprimé !");

        return $this->redirectToRoute("livrets");

    }

    /**
     * @Route("/livrets/new", name="new_livret")
     * @isGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param LivretNamerService $livretNamerService
     * @param usernamePasswordMakerService $userMakerService
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $manager, LivretNamerService $livretNamerService, usernamePasswordMakerService $userMakerService, UserPasswordEncoderInterface $encoder) {

        $livret = new Livret();
        $form = $this->createForm(LivretFormType::class,$livret);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $etudiant = $livret->getEtudiant();
            $maitreStage = $livret->getMaitreStage();
            $profTuteur = $livret->getProfTuteur();

            $etudiant->setNomUtilisateur(
                $userMakerService->generateUsername($etudiant)
            );
            $etudiant->setPassword(
                $encoder->encodePassword(
              $etudiant, $userMakerService->generatePassword($etudiant)
            ));

            $livret->setNomLivret(
                $livretNamerService->generateLivretName($livret)
            );

            $manager->persist($livret);
            $manager->flush();
        }

        return $this->render('livrets/new.html.twig',[
            'form' => $form->createView()
        ]);

    }


}
