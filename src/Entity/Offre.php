<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
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
    private $sommaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tempsDeLivraison;


    /**
     * @ORM\OneToMany(targetEntity=Collaboration::class, mappedBy="offre", orphanRemoval=true)
     */
    private $collaborations;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
        $this->collaborations = new ArrayCollection();
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

    public function getSommaire(): ?string
    {
        return $this->sommaire;
    }

    public function setSommaire(string $sommaire): self
    {
        $this->sommaire = $sommaire;

        return $this;
    }

    public function getTempsDeLivraison(): ?string
    {
        return $this->tempsDeLivraison;
    }

    public function setTempsDeLivraison(string $tempsDeLivraison): self
    {
        $this->tempsDeLivraison = $tempsDeLivraison;

        return $this;
    }
    
    /**
     * @return Collection|Collaboration[]
     */
    public function getCollaborations(): Collection
    {
        return $this->collaborations;
    }

    public function addCollaboration(Collaboration $collaboration): self
    {
        if (!$this->collaborations->contains($collaboration)) {
            $this->collaborations[] = $collaboration;
            $collaboration->setOffre($this);
        }

        return $this;
    }

    public function removeCollaboration(Collaboration $collaboration): self
    {
        if ($this->collaborations->removeElement($collaboration)) {
            // set the owning side to null (unless already changed)
            if ($collaboration->getOffre() === $this) {
                $collaboration->setOffre(null);
            }
        }

        return $this;
    }
}
