<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @Groups ("commande:read")
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups ("commande:read")
     * @Assert\NotBlank
     */
    private $prix_total;

    /**
     * @ORM\Column(type="datetime")
     * @Groups ("commande:read")
     * @Assert\NotBlank
     * @Assert\Date
     * @var string A "Y-m-d" formatted value
     */
    private $date_com;

    /**
     * @ORM\Column(type="datetime")
     * @Groups ("commande:read")
     * @Assert\NotBlank
     * @Assert\DateTime
     * @var string A "Y-m-d H:i:s" formatted value
     */
    private $date_ab;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("commande:read")
     * @Assert\NotBlank
     */
    private $etat_paiement;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("commande:read")
     * @Assert\NotBlank
     */
    private $mode_paiement;
    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="date")
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=Lignecommande::class, mappedBy="commande")
     */
    private $id_commande;

    public function __construct()
    {
        $this->titre_Mat = new ArrayCollection();
        $this->id_commande = new ArrayCollection();
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
     * @return Collection|Lignecommande[]
     */
    public function getIdCommande(): Collection
    {
        return $this->id_commande;
    }

    public function addIdCommande(Lignecommande $idCommande): self
    {
        if (!$this->id_commande->contains($idCommande)) {
            $this->id_commande[] = $idCommande;
            $idCommande->setCommande($this);
        }

        return $this;
    }

    public function removeIdCommande(Lignecommande $idCommande): self
    {
        if ($this->id_commande->removeElement($idCommande)) {
            // set the owning side to null (unless already changed)
            if ($idCommande->getCommande() === $this) {
                $idCommande->setCommande(null);
            }
        }

        return $this;
    }

}
