<?php

namespace App\Controller\Admin;

use App\Entity\Repertoire;
use App\Entity\Utilisateur;
use App\Repository\RepertoireRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUtilisateurController extends AbstractController
{



    // #[Route('/admin/utilisateur', name: 'admin_utilisateurs')]

    // public function utilisateursAdmin(UtilisateurRepository $repository): Response
    // {
    //     $utilisateurs = $repository->findAll();
    //     return $this->render('admin/admin_utilisateur/index.html.twig',[
    //         'utilisateurs'=> $utilisateurs,
    //     ]);
    // }
}
