<?php

namespace App\Entity;

use App\Repository\MaterielsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection; 
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielsRepository::class)
 */
class Materiels
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
    private $Titre_Mat;

    /**
     * @ORM\Column(type="float")
     */
    private $Prix_Mat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image_Mat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Descr_mat;

    /**
     * @ORM\Column(type="integer")
     */
    private $Stock_Mat;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="titre_Mat")
     */
    private $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreMat(): ?string
    {
        return $this->Titre_Mat;
    }

    public function setTitreMat(string $Titre_Mat): self
    {
        $this->Titre_Mat = $Titre_Mat;

        return $this;
    }
    public function getPrixMat(): ?float
    {
        return $this->Prix_Mat;
    }

    public function setPrixMat(float $Prix_Mat): self
    {
        $this->prixMat = $Prix_Mat;

        return $this;
    }
    public function getImageMat(): ?string
    {
        return $this->Image_Mat;
    }

    public function setImageMat(string $Image_Mat): self
    {
        $this->Image_Mat = $Image_Mat;

        return $this;
    }

    public function getDescrMat(): ?string
    {
        return $this->Descr_mat;
    }

    public function setDescrMat(string $Descr_mat): self
    {
        $this->Descr_mat = $Descr_mat;

        return $this;
    }

    public function getStockMat(): ?int
    {
        return $this->Stock_Mat;
    }

    public function setStockMat(int $Stock_Mat): self
    {
        $this->Stock_Mat = $Stock_Mat;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addTitreMat($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeTitreMat($this);
        }

        return $this;
    }
}
