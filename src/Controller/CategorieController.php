<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/Categorie/liste', name: 'gescategorie')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        
        $cat = new Categorie();
        $form = $this->createForm(CategorieType::class, $cat, array('action' => $this->generateUrl('ajoutcategorie')));
        $data['form'] = $form->createView();
        $data['categories'] = $em->getRepository(Categorie::class)->findAll();
        return $this->render('categorie/catego.html.twig', $data);
    }

    #[Route('/Categorie/ajout', name: 'ajoutcategorie')]
    public function ajout(Request $request, ManagerRegistry $doctrine):Response
    {
        $cat = new Categorie();
        $form = $this->createForm(CategorieType::class, $cat, array('action' => $this->generateUrl('ajoutcategorie')));
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $cat = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($cat);
            $em->flush();
            
        }
        
        return $this->redirectToRoute('gescategorie');
    }
}