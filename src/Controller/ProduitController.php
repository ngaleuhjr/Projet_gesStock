<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ProduitType;
use App\Entity\Produit;

class ProduitController extends AbstractController
{
    #[Route('/Produit/liste', name: 'produit_liste')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $p = new Produit();
        $form = $this->createForm(ProduitType::class, $p, 
                                    array('action' => $this->generateUrl('produit_add'),
                                ));
        $data['form'] = $form->createView();

        $data['produits'] = $em->getRepository(Produit::class)->findAll();
        return $this->render('produit/liste.html.twig', $data);
    }

    #[Route('/Produit/get/{$id}', name: 'produit_get')]
    public function getProduit($id): Response
    {
        return $this->render('produit/liste.html.twig');
    }

    #[Route('/Produit/add', name: 'produit_add')]
    public function add(ManagerRegistry $doctrine, Request $request)
    {
        $p = new Produit();
        $form = $this->createForm(ProduitType::class, $p);
        
        $form->handleRequest($request);
        if ($form->isValid()) 
        {
            $p = $form->getData();

            $em = $doctrine->getManager();
            $em->persist($p);
            $em->flush();
        }
        return $this->redirectToRoute('produit_liste');
    }
}
