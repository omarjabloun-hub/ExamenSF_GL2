<?php

namespace App\Controller;

use App\Entity\PFE;
use Doctrine\Persistence\ManagerRegistry ;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    #[Route('/stat/{numPage<\d+>?1}', name: 'app_stat')]
    public function index(ManagerRegistry $doctrine ,$numPage): Response
    {
        $repo = $doctrine->getRepository(PFE::class ) ;
       $req = $repo->PfeGroupedByEntreprise( 10, 10*($numPage - 1) ) ;
       $req1 = $repo->PfeGroupedByEntreprise(200,0) ;
        $nbPage = ceil(count($req1) / 10)   ;
        return $this->render('stat/index.html.twig', [
            'res' => $req,
            'numPage'=> $numPage ,
            'nbPage' => $nbPage ,
        ]);
    }
}
