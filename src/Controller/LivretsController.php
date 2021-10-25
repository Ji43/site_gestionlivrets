<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Livret;
use App\Entity\MaitreApprentissage;
use App\Entity\Periode;
use App\Entity\ProfTuteur;
use App\Form\LivretFormType;
use App\Repository\LivretRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            $donnees,$request->query->getInt('page',1),10
        );

        return $this->render('livrets/index.html.twig', [
            'livrets' => $livrets
         ]);
    }

    /**
     * Permet d'afficher la vue d'un livret
     *
     * @Route("/livrets/show/{id}", name="show_livret")
     * @Security("is_granted('ROLE_ADMIN') or livret.isConcerned(user)", message="Vous n'avez aucun lien avec ce livret, il est donc impossible pour vous de le consulter.")
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
     *
     * @Route("/livrets/delete/{id}", name="delete_livret")
     * @Security("is_granted('ROLE_ADMIN') or user === livret.getEtudiant()", message="Ce livret ne vous appartient pas, vous ne pouvez pas le supprimer")
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
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $manager) {

        $livret = new Livret();
        $livret->setNomLivret("Livret d'essais");
        $livret->setFormation($manager->getRepository(Formation::class)->findOneBy([
            'id' => 1
        ]));
        $livret->setMaitreApprentissage($manager->getRepository(MaitreApprentissage::class)->findOneBy([
            'id' => 1
        ]));
        $livret->setProfTuteur($manager->getRepository(ProfTuteur::class)->findOneBy([
            'id' => 1
        ]));
        $livret->setPeriode($manager->getRepository(Periode::class)->findOneBy([
            'id' => 1
        ]));

        $form = $this->createForm(LivretFormType::class,$livret);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $manager->persist($livret);
            $manager->flush();

            $this->addFlash('success','Le livret a bien été enregistré avec succès !');
        }

        return $this->render('livrets/new.html.twig',[
            'form' => $form->createView()
        ]);

    }


}
