<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name:"Users")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user_profile'])]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user_profile'])]
    private $lastname;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user_profile'])]
    private $age;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user_profile'])]
    private $gender;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $role;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['user_profile'])]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['user_profile'])]
    private $updatedAt;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CigarettesStat::class)]
    #[Groups(['user_cigarettesStats'])]
    private $cigarettesStats;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: StepsStat::class)]
    #[Groups(['user_stepsStats'])]
    private $stepsStats;
    
    #[Groups(['user_challenges'])]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Challenge::class)]
    private $challenges;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user_profile'])]
    private $avatar;

    public function __construct()
    {
        $this->cigarettesStats = new ArrayCollection();
        $this->stepsStats = new ArrayCollection();
        $this->challenges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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

    /**
     * @return Collection|CigarettesStat[]
     */
    public function getCigarettesStats(): Collection
    {
        return $this->cigarettesStats;
    }

    public function addCigarettesStat(CigarettesStat $cigarettesStat): self
    {
        if (!$this->cigarettesStats->contains($cigarettesStat)) {
            $this->cigarettesStats[] = $cigarettesStat;
            $cigarettesStat->setUser($this);
        }

        return $this;
    }

    public function removeCigarettesStat(CigarettesStat $cigarettesStat): self
    {
        if ($this->cigarettesStats->removeElement($cigarettesStat)) {
            // set the owning side to null (unless already changed)
            if ($cigarettesStat->getUser() === $this) {
                $cigarettesStat->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|StepsStat[]
     */
    public function getStepsStats(): Collection
    {
        return $this->stepsStats;
    }

    public function addStepsStat(StepsStat $stepsStat): self
    {
        if (!$this->stepsStats->contains($stepsStat)) {
            $this->stepsStats[] = $stepsStat;
            $stepsStat->setUser($this);
        }

        return $this;
    }

    public function removeStepsStat(StepsStat $stepsStat): self
    {
        if ($this->stepsStats->removeElement($stepsStat)) {
            // set the owning side to null (unless already changed)
            if ($stepsStat->getUser() === $this) {
                $stepsStat->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Challenge[]
     */
    public function getChallenges(): Collection
    {
        return $this->challenges;
    }

    public function addChallenge(Challenge $challenge): self
    {
        if (!$this->challenges->contains($challenge)) {
            $this->challenges[] = $challenge;
            $challenge->setUser($this);
        }

        return $this;
    }

    public function removeChallenge(Challenge $challenge): self
    {
        if ($this->challenges->removeElement($challenge)) {
            // set the owning side to null (unless already changed)
            if ($challenge->getUser() === $this) {
                $challenge->setUser(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
