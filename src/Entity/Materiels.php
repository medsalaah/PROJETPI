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
     * @ORM\OneToMany(targetEntity=Lignecommande::class, mappedBy="materiels")
     */
    private $id_Mat;

    /**
     * @ORM\OneToMany(targetEntity=Lignelocation::class, mappedBy="materiels")
     */
    private $relation;

    public function __construct()
    {
        $this->id_Mat = new ArrayCollection();
        $this->relation = new ArrayCollection();
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
       $this->Prix_Mat = $Prix_Mat;

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
     * @return Collection|Lignecommande[]
     */
    public function getIdMat(): Collection
    {
        return $this->id_Mat;
    }

    public function addIdMat(Lignecommande $idMat): self
    {
        if (!$this->id_Mat->contains($idMat)) {
            $this->id_Mat[] = $idMat;
            $idMat->setMateriels($this);
        }

        return $this;
    }

    public function removeIdMat(Lignecommande $idMat): self
    {
        if ($this->id_Mat->removeElement($idMat)) {
            // set the owning side to null (unless already changed)
            if ($idMat->getMateriels() === $this) {
                $idMat->setMateriels(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lignelocation[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Lignelocation $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setMateriels($this);
        }

        return $this;
    }

    public function removeRelation(Lignelocation $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getMateriels() === $this) {
                $relation->setMateriels(null);
            }
        }

        return $this;
    }
}
