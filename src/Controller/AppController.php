<?php

namespace App\Controller;

use App\Repository\RecoRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app")
 */
class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(UserRepository $userRepo): Response
    {
        $membres = $userRepo->findAll();
        return $this->render('app/index.html.twig', [
            'membres' => $membres
        ]);
    }

    /**
     * @Route("/recos", name="recos_read")
     */
    public function readRecos(): Response
    {
        return $this->render('app/read-recos.html.twig');
    }
}
