<?php

namespace App\Entity;

use App\Repository\CollaborationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollaborationRepository::class)
 */
class Collaboration
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $remuneration;

    /**
     * @ORM\ManyToOne(targetEntity=Freelancer::class, inversedBy="collaborations")
     */
    private $freelancer;

    /**
     * @ORM\ManyToOne(targetEntity=Offre::class, inversedBy="collaborations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offre;


    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRemuneration(): ?int
    {
        return $this->remuneration;
    }

    public function setRemuneration(int $remuneration): self
    {
        $this->remuneration = $remuneration;

        return $this;
    }

    public function getFreelancer(): ?freelancer
    {
        return $this->freelancer;
    }

    public function setFreelancer(?freelancer $freelancer): self
    {
        $this->freelancer = $freelancer;

        return $this;
    }

    public function getOffre(): ?offre
    {
        return $this->offre;
    }

    public function setOffre(?offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }

    }
