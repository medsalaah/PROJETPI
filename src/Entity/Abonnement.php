<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AbonnementRepository::class)
 */
class Abonnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 10)
     */
    private $libelle_ab;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private $prix_ab;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     * @Assert\Date
     * @var string A "Y-m-d" formatted value
     */
    private $date_ab;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="abonnement")
     * @Assert\NotBlanK
     */
    private $nom;

    public function __construct()
    {
        $this->nom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleAb(): ?string
    {
        return $this->libelle_ab;
    }

    public function setLibelleAb(string $libelle_ab): self
    {
        $this->libelle_ab = $libelle_ab;

        return $this;
    }

    public function getPrixAb(): ?float
    {
        return $this->prix_ab;
    }

    public function setPrixAb(float $prix_ab): self
    {
        $this->prix_ab = $prix_ab;

        return $this;
    }

    public function getDateAb(): ?\DateTimeInterface
    {
        return $this->date_ab;
    }

    public function setDateAb(\DateTimeInterface $date_ab): self
    {
        $this->date_ab = $date_ab;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getNom(): Collection
    {
        return $this->nom;
    }

    public function addNom(Utilisateur $nom): self
    {
        if (!$this->nom->contains($nom)) {
            $this->nom[] = $nom;
            $nom->setAbonnement($this);
        }

        return $this;
    }

    public function removeNom(Utilisateur $nom): self
    {
        if ($this->nom->removeElement($nom)) {
            // set the owning side to null (unless already changed)
            if ($nom->getAbonnement() === $this) {
                $nom->setAbonnement(null);
            }
        }

        return $this;
    }
}
