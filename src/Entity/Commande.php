<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ("commande:read")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups ("commande:read")
     */
    private $prix_total;

    /**
     * @ORM\Column(type="datetime")
     * @Groups ("commande:read")
     */
    private $date_com;

    /**
     * @ORM\Column(type="datetime")
     * @Groups ("commande:read")
     */
    private $date_ab;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("commande:read")
     */
    private $etat_paiement;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("commande:read")
     */
    private $mode_paiement;

    /**
     * @ORM\ManyToMany(targetEntity=Materiels::class, inversedBy="commandes")
     */
    private $titre_Mat;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="date")
     */
    private $utilisateur;

    public function __construct()
    {
        $this->titre_Mat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prix_total;
    }

    public function setPrixTotal(float $prix_total): self
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->date_com;
    }

    public function setDateCom(\DateTimeInterface $date_com): self
    {
        $this->date_com = $date_com;

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

    public function getEtatPaiement(): ?string
    {
        return $this->etat_paiement;
    }

    public function setEtatPaiement(string $etat_paiement): self
    {
        $this->etat_paiement = $etat_paiement;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->mode_paiement;
    }

    public function setModePaiement(string $mode_paiement): self
    {
        $this->mode_paiement = $mode_paiement;

        return $this;
    }

    /**
     * @return Collection|Materiels[]
     */
    public function getTitreMat(): Collection
    {
        return $this->titre_Mat;
    }

    public function addTitreMat(Materiels $titreMat): self
    {
        if (!$this->titre_Mat->contains($titreMat)) {
            $this->titre_Mat[] = $titreMat;
        }

        return $this;
    }

    public function removeTitreMat(Materiels $titreMat): self
    {
        $this->titre_Mat->removeElement($titreMat);

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
