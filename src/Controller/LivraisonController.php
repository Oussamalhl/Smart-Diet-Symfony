<?php

namespace App\Controller;

use App\Form\LivraisonType;
use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Livraison;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;

class LivraisonController extends AbstractController
{
    /**
     * @Route("/livraison", name="livraison")
     */
    public function index(LivraisonRepository $repository)

    {   $livraison=$repository->findAll();
        return $this->render('livraison/livraison.html.twig',
            ['livraison' => $livraison
        ]);
    }
    /**
     * @param LivraisonRepository $repository
     * @return Response
     * @Route("/Affichedash",name="Affichedash")
     */
    public function Affichedash(LivraisonRepository $repository){
        //$repo=$this->getDoctrine()->getRepository(Classroom::class);
        $livraison=$repository->findAll();
        return $this->render('livraison/dashboard.html.twig',
            ['livraison'=>$livraison]);
    }
    /**
     * @Route("/Deldash/{id}",name="suppD")
     */
    function SupprimerD($id,LivraisonRepository $repository){
        $livraison=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($livraison);
        $em->flush();
        return $this->redirectToRoute('Affichedash');

    }
    /**
     * @param LivraisonRepository $repository
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("livraisondash/Update/{id}",name="updateD")
     */
    function ModifierD(LivraisonRepository $repository,$id,Request $request){
        $livraison = $repository->find($id);
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->add('Modifier', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('Affichedash');

        }
        return $this->render('livraison/Update.html.twig',
            [
                'form' => $form->createView()
            ]);
    }





    /**
     * @param LivraisonRepository $repository
     * @return Response
     * @Route("/AfficheLivraison",name="AfficheLivraison")
     */
    public function Affiche(LivraisonRepository $repository){
        //$repo=$this->getDoctrine()->getRepository(Classroom::class);
        $livraison=$repository->findAll();
        return $this->render('livraison/AfficheLivraison.html.twig',
            ['livraison'=>$livraison]);
    }

    /**
     * @Route("/Del/{id}",name="supp")
     */
    function Supprimer($id,LivraisonRepository $repository){
        $livraison=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($livraison);
        $em->flush();
        return $this->redirectToRoute('livraison');

    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("livraison/Add",name="add")
     */
    function Ajouter(Request $request){
        $livraison=new Livraison();
        $form=$this->createForm(LivraisonType::class,$livraison);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($livraison);
            $em->flush();
            return $this->redirectToRoute('Affichedash');
        }
        return $this->render('livraison/Add.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @param LivraisonRepository $repository
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("livraison/Update/{id}",name="update")
     */
    function Modifier(LivraisonRepository $repository,$id,Request $request){
        $livraison = $repository->find($id);
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->add('Modifier', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficheLivraison');

        }
        return $this->render('livraison/Update.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}
