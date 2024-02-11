<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use App\Repository\MedecinRepository;
use App\Repository\RendezvousRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RendezvousController extends AbstractController
{
    #[Route('/rendezvous', name: 'app_rendezvous')]
    public function index(): Response
    {
        return $this->render('rendezvous/index.html.twig', [
            'controller_name' => 'RendezvousController',
        ]);
    }

    #[Route('/indexadmin', name: 'indexadmin')]
    public function indexadmin(): Response
    {
        return $this->render('admin/indexadmin.html.twig'
        );
    }

    #[Route('/show', name: 'show')]
    public function show(RendezvousRepository $rendezvousRepository): Response
    {
        $rd=$rendezvousRepository->findAll();
        $medecinname=[];
        foreach($rd as $rendezvous){
            $medecinname[]=$rendezvous->getMedecin()->getFullname();
        }
        return $this->render('admin/show.html.twig', [
            'rendezvous' => $rd,
            'medecinsname' =>$medecinname
        ]);
    }

    #[Route('/addRV', name: 'addRV')]
    public function addRV(ManagerRegistry $managerRegistry,Request $request): Response
    {
        $x=$managerRegistry->getManager();
        

        $rd=new Rendezvous();
        $form=$this->createForm(RendezvousType::class,$rd);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $medecin=$rd->getMedecin();
           // $spec=$rd->$medecin->getSpecialite();
            $x->persist($medecin);
            //$x->persist($spec);
            $x->persist($rd);
            $x->flush();
            return $this->redirectToRoute('show');

        }
        return $this->renderForm('admin/addRV.html.twig', [
            'f' => $form,
        ]);
    }

    #[Route('/deleteRV/{id}', name: 'deleteRV')]
    public function deleteRV(ManagerRegistry $managerRegistry,$id,RendezvousRepository $rendezvous): Response
    {
        $x=$managerRegistry->getManager();
        $rd=$rendezvous->find($id);
        $x->remove($rd);
        $x->flush();
        return $this->redirectToRoute('show');
    }

    #[Route('/editrv/{id}', name: 'editrv')]
    public function editrv(ManagerRegistry $managerRegistry,RendezvousRepository $repositery,Request $req,$id): Response
    {
        $x=$managerRegistry->getManager();
        $rd=$repositery->find($id);
        $form=$this->createForm(RendezvousType::class,$rd);
        $form->handleRequest($req);
        if($form->isSubmitted() and $form->isValid()){
            $x->persist($rd);
            $x->flush();
            return $this->redirectToRoute('show');
        }

        return $this->renderForm('admin/editrv.html.twig', [
            'f' => $form
        ]);
    }
    
}
