<?php

namespace App\Entity;

use App\Entity\Repertoire;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhotoRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 * @Vich\Uploadable
 */
class Photo
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
    private $image;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Repertoire::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $repertoire;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Assert\Image(mimeTypes = "image/jpeg", mimeTypesMessage = "L'image doit être de type .jpeg")
     * @Vich\UploadableField(mapping="photo_image", fileNameProperty="image")
     * 
     */
    private $imageFile;

   

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     */
    // public function setImageFile(?File $imageFile = null): self
    // {
    //     $this->imageFile = $imageFile;

    //     if($this->imageFile instanceof UploadedFile){
    //         $this->updated_at= new \DateTimeImmutable();
    //     }
    //     return $this;

    // }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated_at = new \DateTimeImmutable();
        }
        // if (null !== $imageFile) {
        //     // It is required that at least one field changes if you are using doctrine
        //     // otherwise the event listeners won't be called and the file is lost
        //     $this->updatedAt = new \DateTimeImmutable();
        // }
        return $this;
    }
   
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

   
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getRepertoire(): ?Repertoire
    {
        return $this->repertoire;
    }

    public function setRepertoire(?Repertoire $repertoire): self
    {
        $this->repertoire = $repertoire;

        return $this;
    }
    
}
