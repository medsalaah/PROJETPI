<?php

namespace App\Entity;

use App\Repository\OrganisateurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrganisateurRepository::class)
 */
class Organisateur
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
    private $lien_sociaux;

    /**
     * @ORM\Column(type="integer")
     */
    private $Nbr_followers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLienSociaux(): ?string
    {
        return $this->lien_sociaux;
    }

    public function setLienSociaux(string $lien_sociaux): self
    {
        $this->lien_sociaux = $lien_sociaux;

        return $this;
    }

    public function getNbrFollowers(): ?int
    {
        return $this->Nbr_followers;
    }

    public function setNbrFollowers(int $Nbr_followers): self
    {
        $this->Nbr_followers = $Nbr_followers;

        return $this;
    }
}
