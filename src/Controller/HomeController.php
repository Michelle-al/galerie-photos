<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TagRepository;
use App\Repository\RepertoireRepository;

class HomeController extends AbstractController
{
#[Route('/', name: 'home')]
    public function index(RepertoireRepository $repertoireRepo, TagRepository $tagRepo): Response
    {
    $page = "home";
    $repertoires = $repertoireRepo->findBy([], ['id' => 'DESC'], 3);
    
    return $this->render('home/index.html.twig', compact('repertoires', 'page'));
    }

}
