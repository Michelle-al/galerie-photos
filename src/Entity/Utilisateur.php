<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Repertoire::class, mappedBy="utilisateur", orphanRemoval=true)
     */
    private $repertoire;

    public function __construct()
    {
        $this->repertoire = new ArrayCollection();
    }

    private $passwordVerif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles(): ?bool
    {
        return $this->roles;
    }

    public function setRoles(bool $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCivilite(): ?bool
    {
        return $this->civilite;
    }

    public function setCivilite(?bool $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPasswordVerif(){
        return $this->passwordVerif;
    }
   

    
    public function eraseCredentials(){
    }

    /**
     * @return Collection|Repertoire[]
     */
    public function getRepertoire(): Collection
    {
        return $this->repertoire;
    }

    public function addRepertoire(Repertoire $repertoire): self
    {
        if (!$this->repertoire->contains($repertoire)) {
            $this->repertoire[] = $repertoire;
            $repertoire->setUtilisateur($this);
        }

        return $this;
    }

    public function removeRepertoire(Repertoire $repertoire): self
    {
        if ($this->repertoire->removeElement($repertoire)) {
            // set the owning side to null (unless already changed)
            if ($repertoire->getUtilisateur() === $this) {
                $repertoire->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

  

}
