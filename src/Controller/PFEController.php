<?php

namespace App\Controller;

use App\Form\PfeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PFE;

class PFEController extends AbstractController
{
    #[Route('/pfe/{numPage<\d+>?1}', name: 'app_pfe_root')]
    public function index2(ManagerRegistry $doctrine , $numPage): Response
    {
        $repo = $doctrine->getRepository(PFE::class);
        $pfes = $repo->findBy([] ,array() , 10 ,10*$numPage);
        $nbPage = ceil($repo->count([]) / 10)-1 ;
        return $this->render('pfe/index.html.twig', [
            'pfeet' => $pfes ,
            'numPage'=> $numPage ,
            'nbPage' => $nbPage ,

        ]);
    }

    #[Route('/pfe/add', name: 'app_pfe_add')]
    public function index3(Request $request , ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $pfe = new Pfe();

        $form = $this->createForm(PfeType::class, $pfe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $pfe = $form->getData();
            $entityManager->persist($pfe);
            $entityManager->flush();
            $this->addFlash('success' , 'Ajout avec succes');
            return $this->render('pfe/new.html.twig',[
                'pfe' => $pfe ,
            ]);
        } else {
            return $this->renderForm('pfe/addPfe.html.twig', [
                'form' => $form,
            ]);
        }


    }
}