<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Photo;
use App\Entity\Repertoire;
use App\Form\RepertoireType;
use App\Repository\PhotoRepository;
use App\Repository\RepertoireRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminRepertoireController extends AbstractController
{
    /**
     * @var RepertoireRepository
     */

    private $repository;
    private $repo;
    private $em;
    private $repoTag;
    public function __construct(RepertoireRepository $repository, EntityManagerInterface $em, UtilisateurRepository $repo, TagRepository $repoTag){
        $this->repository = $repository;
        $this->em = $em;
        $this->repo = $repo;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $page = 'admin';
        $repertoires = $this->repository->findCount();
        $utilisateurs = $this->repo->findCountUsers();
        return $this->render('admin/index.html.twig',[
            'repertoires'=> $repertoires,
            'utilisateurs'=> $utilisateurs,
            'page' => $page
        ]);
        return $this->render('admin/index.html.twig');
    }

    #[Route('/admin/galerie', name: 'admin_repertoires')]
    public function repertoiresAdmin(): Response
    {
        $page = 'admin-galerie';
        $repertoires = $this->repository->findAll();
        return $this->render('admin/repertoires/index.html.twig',[
            'repertoires'=> $repertoires,
            'page' => $page
        ]);
    }

    #[Route('/admin/galerie/nouveau', name: 'admin_repertoires.create', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {   
        $page = "admin";
        $repertoire = new Repertoire(); 
        $form = $this->createForm(RepertoireType::class, $repertoire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $photos = $repertoire->getPhotos();
            foreach($photos as $key => $photo){
                $photo->setRepertoire($repertoire);
                $photos->set($key,$photo);
                dump($photos);
                dump($photo);
            }
            
            $repertoire->setCreatedAt(new \DateTimeImmutable());

            //Tags
            $tags = $repertoire->getTags();
            foreach($tags as $key => $tag){
                $tag->addRepertoire($repertoire);
                $tags->set($key,$tag);
            }

            $this->em->persist($repertoire);
            $this->em->flush();

            $this->addFlash("success", "Le  répertoire a bien été créé");

            return $this->redirectToRoute('admin_repertoires');
        }
        return $this->render('admin/repertoires/create.html.twig',[
            'repertoire'=> $repertoire,
            'form'=> $form->createView(),
            'page' => $page
        ]);
    }

    #[Route('/admin/galerie/modifier/{id}', name: 'admin_repertoires.edit')]
    public function edit(Request $request, Repertoire $repertoire, TagRepository $tagRepo): Response
    {
        $tagList = $tagRepo->findBy([], ['libelle' => 'ASC']);
        $page = 'admin';
        //Photos
        $originalPhotos = new ArrayCollection();

        // Create an ArrayCollection of the current Photo objects in the database
        foreach ($repertoire->getPhotos() as $photo) {
            $originalPhotos->add($photo);
        }
        dump($originalPhotos);
        dump($photo);
        $form = $this->createForm
        (RepertoireType::class, $repertoire);
        $form->handleRequest($request);
        dump($request->request);
        if($form->isSubmitted() && $form->isValid()){
            // remove the relationship between the photo and the Repertoire
            if(isset($request->request->get('repertoire')['photos'])){
                /** @var array $deletePhoto */
                $deletePhoto = $request->request->get('repertoire')['photos'];
                
               
                foreach($deletePhoto as $key1 => $value){
                    
                    
                        foreach ($originalPhotos as $key =>$photo) {
                           
                            if($key1 == $key){
                                $originalPhotos->set($key1, $photo);

                                $repertoire->removePhoto($photo);
                        
                                $this->em->persist($photo);
                                $this->em->remove($photo);
                            }
                        } 
                }
            }
            //Tags
            $tags = $repertoire->getTags();
            
            dump($tagList);
            dump($tags);
            // $tagDb = $this->repoTag->findOneBy(array('libelle'=> '2016'));
            // dump($tagDb);
            foreach($tags as $key => $tag){
                
                $tag->addRepertoire($repertoire);
                $tags->set($key,$tag);
            }
            dump($tags);

            // $this->em->persist($repertoire);
            // $this->em->flush();
            
            $this->addFlash("success", "Les modifications ont bien été effectuée");

            // return $this->redirectToRoute('admin_repertoires');
            
        }

        return $this->render('admin/repertoires/edit.html.twig',[
            'repertoire'=> $repertoire,
            'form'=> $form->createView(),
            'id' => $repertoire->getId(),
            'page' => $page,
            'tagList' => $tagList
        ]);
    }

    #[Route('/admin/galerie/delete/{id}', name: 'admin_repertoire.delete')]
    public function delete(): Response
    {
        $page = 'admin';
        $repertoires = $this->repository->findAll();
        return $this->render('admin/repertoires/index.html.twig',compact('repertoires', 'page'));
    }

    
}
