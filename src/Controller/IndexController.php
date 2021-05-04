<?php

namespace App\Controller;

use App\Entity\Building;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $req = $this->getDoctrine()
            ->getRepository(Building::class)
            ->findAll();

        return $this->render('index/index.html.twig', [
            'req' => $req
        ]);
    }
}
