<?php

namespace App\Controller;

use App\Entity\Collaboration;
use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\FreelancerRepository;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/offre")
 */
class OffreController extends AbstractController
{
    /**
     * @Route("/", name="offre_index", methods={"GET"})
     */
    public function index(OffreRepository $offreRepository): Response
    {
        return $this->render('offre/index.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="offre_new", methods={"GET","POST"})
     */
    public function new(Request $request, FreelancerRepository $freelancerRepository): Response
    {
        $offre = new Offre();

        $username = $request->getSession()->get(Security::LAST_USERNAME);
        $user = $freelancerRepository->findOneBy(['username' => $username]);
        $userCollaboration = new Collaboration();
        $userCollaboration->setOffre($offre);
        $userCollaboration->setFreelancer($user);
        $offre->getCollaborations()->add($userCollaboration);

        $collaboration = new Collaboration();
        $collaboration->setOffre($offre);
        $offre->getCollaborations()->add($collaboration);
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('offre_index');
        }

        return $this->render('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offre_show", methods={"GET"})
     */
    public function show(Offre $offre): Response
    {
        $prix = 0;
        foreach ($offre->getCollaborations() as $collaboration){
            $prix += $collaboration->getRemuneration();
        }
        return $this->render('offre/show.html.twig', [
            'offre' => $offre,
            'price' => $prix
        ]);
    }

    /**
     * @Route("/{id}/edit", name="offre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offre $offre): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offre_index');
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offre_delete", methods={"POST"})
     */
    public function delete(Request $request, Offre $offre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offre_index');
    }
}
