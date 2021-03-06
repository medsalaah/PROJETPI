<?php

namespace App\Entity;

use App\Repository\ExpriencesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpriencesRepository::class)
 */
class Expriences
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
    private $descrition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="description")
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescrition(): ?string
    {
        return $this->descrition;
    }

    public function setDescrition(string $descrition): self
    {
        $this->descrition = $descrition;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
