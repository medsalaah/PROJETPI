<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ("article:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("article:read")
     */
    private $titre_art;

    /**
     * @ORM\Column(type="date")
     * @Groups ("article:read")
     */
    private $date_pub_art;

    /**
     * @ORM\Column(type="date")
     * @Groups ("article:read")
     */
    private $date_update;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("article:read")
     */
    private $continu;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("article:read")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="titre_art")
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreArt(): ?string
    {
        return $this->titre_art;
    }

    public function setTitreArt(string $titre_art): self
    {
        $this->titre_art = $titre_art;

        return $this;
    }

    public function getDatePubArt(): ?\DateTimeInterface
    {
        return $this->date_pub_art;
    }

    public function setDatePubArt(\DateTimeInterface $date_pub_art): self
    {
        $this->date_pub_art = $date_pub_art;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

    public function setDateUpdate(\DateTimeInterface $date_update): self
    {
        $this->date_update = $date_update;

        return $this;
    }

    public function getContinu(): ?string
    {
        return $this->continu;
    }

    public function setContinu(string $continu): self
    {
        $this->continu = $continu;

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