<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\CigarettesStatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CigarettesStatRepository::class)]
#[ORM\Table(name:"Cigarettes_Stats")]
class CigarettesStat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['user_cigarettesStats'])]
    private $date;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user_cigarettesStats'])]
    private $cigarettes;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'cigarettesStats')]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCigarettes(): ?int
    {
        return $this->cigarettes;
    }

    public function setCigarettes(int $cigarettes): self
    {
        $this->cigarettes = $cigarettes;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
