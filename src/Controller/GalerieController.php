<?php

namespace App\Controller;

use App\Entity\Repertoire;
use App\Entity\Tag;
use App\Repository\TagRepository;
use App\Repository\RepertoireRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/galerie')]

class GalerieController extends AbstractController
{
    #[Route('/', name: 'galerie')]
    public function index(RepertoireRepository $repertoireRepo, TagRepository $tagRepo, $tag=null): Response
    {
        $repertoires = $repertoireRepo->findBy([], ['annee' => 'DESC']);
        
        $tags = $tagRepo->findBy([], ['libelle' => 'ASC']);
        return $this->render('galerie/index.html.twig', compact('repertoires', 'tag', 'tags'));
    }

    #[Route('/tag/{tag}', name: 'findTag', requirements: ['tag' => '\w+|\w+\s\w+|\s\w+'])]
    public function getCustomiseTag(RepertoireRepository $repertoireRepo, Repertoire $repertoires, TagRepository $tagRepo, Tag $tag): Response
    {
        $tag = $tagRepo->findAll();
      
        $repertoires = $repertoireRepo->findBy([], array('libelle'=> $tag));
        
        return $this->render('galerie/index.html.twig', [
            'repertoires' => $repertoires,
            'tag' => $tag
        
        ]);
    }

    #[Route('/{id}', name: 'galerie-photos')]
    public function photos(Repertoire $repertoire): Response
    {
        return $this->render('galerie/photo.html.twig', [
            'repertoire' => $repertoire
        ]);
    }

    
    
}
