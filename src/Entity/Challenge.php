<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ChallengeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: ChallengeRepository::class)]
#[ORM\Table(name:"Challenges")]
class Challenge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user_challenges'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user_challenges'])]
    #[Assert\NotBlank]
    private $type;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user_challenges'])]
    #[Assert\NotBlank]
    private $state;

    #[ORM\Column(type: 'date')]
    #[Groups(['user_challenges'])]
    private $createdAt;

    #[ORM\Column(type: 'date')]
    #[Groups(['user_challenges'])]
    private $updatedAt;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(['user_challenges'])]
    private $expiredAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'challenges')]
    #[Assert\NotBlank]
    private $user;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user_challenges'])]
    private $goal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getExpiredAt(): ?\DateTimeInterface
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(?\DateTimeInterface $expiredAt): self
    {
        $this->expiredAt = $expiredAt;

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

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal(int $goal): self
    {
        $this->goal = $goal;

        return $this;
    }
}
