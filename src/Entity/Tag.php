<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Repertoire::class, inversedBy="tags")
     */
    private $repertoires;

   
    public function __construct()
    {
        $this->repertoires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->libelle;
        // to show the id of the Category in the select
        // return $this->id;
    }

    /**
     * @return Collection|Repertoire[]
     */
    public function getRepertoires(): Collection
    {
        return $this->repertoires;
    }

    public function addRepertoire(Repertoire $repertoire):self
    {
        if (!$this->repertoires->contains($repertoire)) {
            $this->repertoires[] = $repertoire;
            $repertoire->addTag($this);
        }
        
        return $this;
    }

    public function removeRepertoire(Repertoire $repertoire): self
    {
        if ($this->repertoires->removeElement($repertoire)) {
            $repertoire->removeTag($this);
        }

        return $this;
    }
}
