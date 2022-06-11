<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\SortieType;
use App\Entity\Sortie;
use App\Entity\Produit;


class SortieController extends AbstractController
{
    #[Route('/Sortie/liste', name: 'sortie_liste')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $s = new Sortie();
        $form = $this->createForm(SortieType::class, $s, 
                                    array('action' => $this->generateUrl('sortie_add'),
                                ));
        $data['form'] = $form->createView();

        $data['sorties'] = $em->getRepository(Sortie::class)->findAll();

        return $this->render('sortie/liste.html.twig', $data);
    }

    #[Route('/Sortie/add', name: 'sortie_add')]
    public function add(ManagerRegistry $doctrine, Request $request)
    {
        $s = new Sortie();
        $p = new Produit();
        $form = $this->createForm(SortieType::class, $s);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $doctrine->getManager();
            $s = $form->getData();
            $p = $em->getRepository(Produit::class)->find($s->getProduit()->getId());
            $qtSortie = $s->getQteSortie();
            if($p->getStock() < $s->getQteSortie())
            {
                $s = new Sortie();
                $form = $this->createForm(SortieType::class, $s, 
                                            array('action' => $this->generateUrl('sortie_add'),
                                        ));
                $data['form'] = $form->createView();

                $data['sorties'] = $em->getRepository(Sortie::class)->findAll();
                $data['error_message'] = 'le stock disponible est inférieur à '.$qtSortie;

                return $this->render('sortie/liste.html.twig', $data);
            }else{
                $em->persist($s);
                $em->flush();
                //Mise à jour des produits
                $stock = $p->getStock() - $s->getQteSortie();
                $p->setStock($stock);
                $em->flush();
                
                return $this->redirectToRoute('sortie_liste');
            }
        }
        
    }
}
