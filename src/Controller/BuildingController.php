<?php

namespace App\Controller;

use App\Entity\Building;
use App\Form\BuildingFormType;
use App\Repository\BuildingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            $this->addFlash('Success', 'Annonce Ajoutée avec succéss');
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
    public function deleteFunction($id, Building $building) : Response
    {
        $annonce = true;

        if ($annonce != false){
            echo 'suppresion en cours';
            $this->addFlash('warning', 'Annonce supprimée');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($building);
            $entityManager->remove($building);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        } else {
            echo 'Pas d\'annonce a supprimé';
        }

        

        return $this->render('building/delete.html.twig',[
            'id' => $id,
        ]);
    }
    /**
     * @Route("/update/{id}", name="update")
     */
    public function updateFunction($id, Building $building, Request $request) : Response
    {
        $form = $this->createForm(BuildingFormType::class, $building);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('Success', 'Annonce modifiée');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('building/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
