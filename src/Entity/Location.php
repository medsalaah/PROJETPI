<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Lignelocation::class, mappedBy="location")
     */
    private $id_loc;

    public function __construct()
    {
        $this->id_loc = new ArrayCollection();
    }

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

    /**
     * @return Collection|Lignelocation[]
     */
    public function getIdLoc(): Collection
    {
        return $this->id_loc;
    }

    public function addIdLoc(Lignelocation $idLoc): self
    {
        if (!$this->id_loc->contains($idLoc)) {
            $this->id_loc[] = $idLoc;
            $idLoc->setLocation($this);
        }

        return $this;
    }

    public function removeIdLoc(Lignelocation $idLoc): self
    {
        if ($this->id_loc->removeElement($idLoc)) {
            // set the owning side to null (unless already changed)
            if ($idLoc->getLocation() === $this) {
                $idLoc->setLocation(null);
            }
        }

        return $this;
    }
}
