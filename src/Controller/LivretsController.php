<?php

namespace App\Controller;

use App\Entity\Livret;
use App\Repository\LivretRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function index(LivretRepository $repository): Response
    {
        if($this->isGranted("ROLE_ADMIN")) {
            $livrets = $repository->findAll();
        }
        else {
            $livrets = $this->getUser()->getLivrets();
        }

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

}
