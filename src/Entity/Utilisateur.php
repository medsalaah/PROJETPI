<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="utilisateur")
     */
    private $titre_art;

    /**
     * @ORM\ManyToOne(targetEntity=Abonnement::class, inversedBy="nom")
     */
    private $abonnement;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="utilisateur")
     */
    private $prix_loc;

    /**
     * @ORM\OneToMany(targetEntity=Expriences::class, mappedBy="utilisateur")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="utilisateur")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="utilisateur")
     */
    private $date_res;

    public function __construct()
    {
        $this->titre_art = new ArrayCollection();
        $this->prix_loc = new ArrayCollection();
        $this->description = new ArrayCollection();
        $this->date = new ArrayCollection();
        $this->date_res = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getTitreArt(): Collection
    {
        return $this->titre_art;
    }

    public function addTitreArt(Article $titreArt): self
    {
        if (!$this->titre_art->contains($titreArt)) {
            $this->titre_art[] = $titreArt;
            $titreArt->setUtilisateur($this);
        }

        return $this;
    }

    public function removeTitreArt(Article $titreArt): self
    {
        if ($this->titre_art->removeElement($titreArt)) {
            // set the owning side to null (unless already changed)
            if ($titreArt->getUtilisateur() === $this) {
                $titreArt->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getAbonnement(): ?Abonnement
    {
        return $this->abonnement;
    }

    public function setAbonnement(?Abonnement $abonnement): self
    {
        $this->abonnement = $abonnement;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getPrixLoc(): Collection
    {
        return $this->prix_loc;
    }

    public function addPrixLoc(Location $prixLoc): self
    {
        if (!$this->prix_loc->contains($prixLoc)) {
            $this->prix_loc[] = $prixLoc;
            $prixLoc->setUtilisateur($this);
        }

        return $this;
    }

    public function removePrixLoc(Location $prixLoc): self
    {
        if ($this->prix_loc->removeElement($prixLoc)) {
            // set the owning side to null (unless already changed)
            if ($prixLoc->getUtilisateur() === $this) {
                $prixLoc->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Expriences[]
     */
    public function getDescription(): Collection
    {
        return $this->description;
    }

    public function addDescription(Expriences $description): self
    {
        if (!$this->description->contains($description)) {
            $this->description[] = $description;
            $description->setUtilisateur($this);
        }

        return $this;
    }

    public function removeDescription(Expriences $description): self
    {
        if ($this->description->removeElement($description)) {
            // set the owning side to null (unless already changed)
            if ($description->getUtilisateur() === $this) {
                $description->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getDate(): Collection
    {
        return $this->date;
    }

    public function addDate(Commande $date): self
    {
        if (!$this->date->contains($date)) {
            $this->date[] = $date;
            $date->setUtilisateur($this);
        }

        return $this;
    }

    public function removeDate(Commande $date): self
    {
        if ($this->date->removeElement($date)) {
            // set the owning side to null (unless already changed)
            if ($date->getUtilisateur() === $this) {
                $date->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getDateRes(): Collection
    {
        return $this->date_res;
    }

    public function addDateRe(Reservation $dateRe): self
    {
        if (!$this->date_res->contains($dateRe)) {
            $this->date_res[] = $dateRe;
            $dateRe->setUtilisateur($this);
        }

        return $this;
    }

    public function removeDateRe(Reservation $dateRe): self
    {
        if ($this->date_res->removeElement($dateRe)) {
            // set the owning side to null (unless already changed)
            if ($dateRe->getUtilisateur() === $this) {
                $dateRe->setUtilisateur(null);
            }
        }

        return $this;
    }
}
