<?php

namespace App\Controller;

use App\Repository\RecoRepository;
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
    public function index(): Response
    {
        return $this->render('app/index.html.twig');
    }

    /**
     * @Route("/recos", name="recos_read")
     */
    public function readRecos(): Response
    {
        return $this->render('app/read-recos.html.twig');
    }
}
