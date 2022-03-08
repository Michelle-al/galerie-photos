<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/utilisateur')]
class UtilisateurController extends AbstractController
{   
     /**
     * @var UtilisateurRepository
     */

    private $repository;

    public function __construct(UtilisateurRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
        
    }

    #[Route('/', name: 'admin_utilisateurs', methods: ['GET'])]
    public function index(): Response
    {
        $utilisateurs = $this->repository->findAll();
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    #[Route('/new', name: 'utilisateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'utilisateur_show', methods: ['GET'])]
    public function show(Utilisateur $utilisateur): Response
    {
        if (!$utilisateur) {
            throw $this->createNotFoundException("Cette galerie n'existe pas");
    
            // the above is just a shortcut for:
            // throw new NotFoundHttpException('The product does not exist');
        }
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'utilisateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateur $utilisateur): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success", "L'utilisateur  a bien été créé");

            return $this->redirectToRoute('admin_utilisateurs', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'utilisateur_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateur $utilisateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
