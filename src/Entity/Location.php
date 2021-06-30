<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_recu;

    /**
     * @ORM\Column(type="date")
     */
    private $date_rep;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_loc;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="prix_loc")
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRecu(): ?\DateTimeInterface
    {
        return $this->date_recu;
    }

    public function setDateRecu(\DateTimeInterface $date_recu): self
    {
        $this->date_recu = $date_recu;

        return $this;
    }

    public function getDateRep(): ?\DateTimeInterface
    {
        return $this->date_rep;
    }

    public function setDateRep(\DateTimeInterface $date_rep): self
    {
        $this->date_rep = $date_rep;

        return $this;
    }

    public function getPrixLoc(): ?float
    {
        return $this->prix_loc;
    }

    public function setPrixLoc(float $prix_loc): self
    {
        $this->prix_loc = $prix_loc;

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
