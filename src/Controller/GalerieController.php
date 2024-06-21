<?php

namespace App\Controller;

use App\Entity\Repertoire;
use App\Form\RepertoireType;
use App\Repository\TagRepository;
use App\Repository\RepertoireRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/galerie')]

class GalerieController extends AbstractController
{
    #[Route('/', name: 'galerie')]
    public function index(RepertoireRepository $repertoireRepo, TagRepository $tagRepo, $tag= false): Response
    {
        $page = "galerie";
        $repertoires = $repertoireRepo->findBy([], ['annee' => 'DESC']);
        
        $tags = $tagRepo->findBy([], ['libelle' => 'ASC']);
        return $this->render('galerie/index.html.twig', compact('repertoires', 'tag', 'tags', 'page'));
    }

    #[Route('/tag/{tag}', name: 'findTag')]
    public function getCustomiseTag(RepertoireRepository $repertoireRepo, TagRepository $tagRepo, $tag): Response
    {
        $page = 'galerie';
        $oneTag = $tagRepo->findOneBy(['libelle' => $tag]);
        $tags = $tagRepo->findBy([], ['libelle' => 'ASC']); 
        $tag = $oneTag->getLibelle();
        $repertoires = $repertoireRepo->findByTag($tag);
    
        return $this->render('galerie/index.html.twig', [
            'repertoires' => $repertoires,
            'tag' => $tag,
            'page' => $page,
            'tags' => $tags
             
        
        ]);
    }

    #[Route('/{id}', name: 'galerie-photos')]
    public function photos(Repertoire $repertoire): Response
    {
        $page = "galerie";
        return $this->render('galerie/photo.html.twig', [
            'repertoire' => $repertoire,
            'page' => $page 

        ]);
    }

    
    
}
