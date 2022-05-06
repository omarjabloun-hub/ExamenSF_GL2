<?php

namespace App\Controller;
use App\Form\PfeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PFE;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class PFEController extends AbstractController
{
    #[Route('/add/', name: 'app_add_pfe')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $pfe = new PFE();
        $form = $this->createForm(PfeType::class, $pfe);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager->persist($pfe);
            $entityManager->flush();
            return $this->render('pfe/index.html.twig', ['pfe' => $pfe]);
        } else {
            return $this->render('pfe/index.html.twig', [
                'form' => $form->createView()
            ]);
        }


    }}
