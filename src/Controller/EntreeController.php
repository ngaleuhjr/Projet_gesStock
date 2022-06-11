<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EntreeType;
use App\Entity\Entree;
use App\Entity\Produit;

class EntreeController extends AbstractController
{
    #[Route('/Entree/liste', name: 'entree_liste')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $e = new Entree();
        $form = $this->createForm(EntreeType::class, $e, 
                                    array('action' => $this->generateUrl('entree_add'),
                                ));
        $data['form'] = $form->createView();

        $data['entrees'] = $em->getRepository(Entree::class)->findAll();
        return $this->render('entree/liste.html.twig', $data);
    }
    #[Route('/Entree/add', name: 'entree_add')]
    public function add(ManagerRegistry $doctrine, Request $request)
    {
        $e = new Entree();
        $p = new Produit();
        $form = $this->createForm(EntreeType::class, $e);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $e = $form->getData();

            $em = $doctrine->getManager();
            $em->persist($e);
            $em->flush();
            //Mise à jour des produits
            $p = $em->getRepository(Produit::class)->find($e->getProduit()->getId());
            $stock = $p->getStock() + $e->getQteEntree();
            $p->setStock($stock);
            $em->flush();
        }
        return $this->redirectToRoute('entree_liste');
    }
}
