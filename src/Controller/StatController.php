<?php

namespace App\Controller;

use App\Entity\PFE;
use Doctrine\Persistence\ManagerRegistry ;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    #[Route('/stat', name: 'app_stat')]
    public function index(ManagerRegistry $doctrine ): Response
    {
        $repo = $doctrine->getRepository(PFE::class ) ;
       $req = $repo->PfeGroupedByEntreprise() ;
        return $this->render('stat/index.html.twig', [
            'res' => $req,
        ]);
    }
}
