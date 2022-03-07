<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __toString(): string
    {
        return $this->id;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'datetime')]
    #[Groups(['user_profile'])]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['user_profile'])]
    private $updatedAt;

    #[ORM\Column(type: 'string')]
    private $password;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt( $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt( $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
