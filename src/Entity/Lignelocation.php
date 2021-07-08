<?php

namespace App\Entity;

use App\Repository\LignelocationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LignelocationRepository::class)
 */
class Lignelocation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="id_loc")
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=Materiels::class, inversedBy="id_Matl")
     */
    private $materiels;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getMateriels(): ?Materiels
    {
        return $this->materiels;
    }

    public function setMateriels(?Materiels $materiels): self
    {
        $this->materiels = $materiels;

        return $this;
    }
}
