<?php

namespace App\Controller;

use App\Entity\Building;
use App\Form\BuildingFormType;
use App\Repository\BuildingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class BuildingController extends AbstractController
{
    /**
     * @Route("/building", name="building")
     */
    public function index(HttpFoundationRequest $request): Response
    {
        $building = new Building();
        $form = $this->createForm(BuildingFormType::class, $building);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }
        return $this->render('building/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteFunction(Request $request, $id) : Response
    {
        
        $building = new Building();

        $form = $this->createForm(BuildingFormType::class, $building);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($building);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('building/delete.html.twig');
    }
}
