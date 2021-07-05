<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
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
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $date_deb_even;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin_even;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_even;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_even;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_eve;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_eve;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_participant;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebEven(): ?string
    {
        return $this->date_deb_even;
    }

    public function setDateDebEven(string $date_deb_even): self
    {
        $this->date_deb_even = $date_deb_even;

        return $this;
    }

    public function getDateFinEven(): ?\DateTimeInterface
    {
        return $this->date_fin_even;
    }

    public function setDateFinEven(\DateTimeInterface $date_fin_even): self
    {
        $this->date_fin_even = $date_fin_even;

        return $this;
    }

    public function getPrixEven(): ?float
    {
        return $this->prix_even;
    }

    public function setPrixEven(float $prix_even): self
    {
        $this->prix_even = $prix_even;

        return $this;
    }

    public function getLieuEven(): ?string
    {
        return $this->lieu_even;
    }

    public function setLieuEven(string $lieu_even): self
    {
        $this->lieu_even = $lieu_even;

        return $this;
    }

    public function getImageEve(): ?string
    {
        return $this->image_eve;
    }

    public function setImageEve(string $image_eve): self
    {
        $this->image_eve = $image_eve;

        return $this;
    }

    public function getNbrEve(): ?int
    {
        return $this->nbr_eve;
    }

    public function setNbrEve(int $nbr_eve): self
    {
        $this->nbr_eve = $nbr_eve;

        return $this;
    }

    public function getNbrParticipant(): ?int
    {
        return $this->nbr_participant;
    }

    public function setNbrParticipant(int $nbr_participant): self
    {
        $this->nbr_participant = $nbr_participant;

        return $this;
    }
}
