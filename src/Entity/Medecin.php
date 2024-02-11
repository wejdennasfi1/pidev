<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $username = null;

   


    

    #[ORM\Column(length: 30)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $phone = null;

    #[ORM\Column(length: 20)]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $token = null;

    #[ORM\Column(length: 254, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\Column(length: 25)]
    private ?string $role = null;

    #[ORM\Column(length: 30)]
    private ?string $specialite = null;

    #[ORM\Column(length: 30)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Rendezvous::class, orphanRemoval: true)]
    private Collection $rendezvouses;

    #[ORM\Column(length: 30)]
    private ?string $fullname = null;

    public function __construct()
    {
        $this->rendezvouses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    

    

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getToken(): ?int
    {
        return $this->token;
    }

    public function setToken(int $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Rendezvous>
     */
    public function getRendezvouses(): Collection
    {
        return $this->rendezvouses;
    }

    public function addRendezvouse(Rendezvous $rendezvouse): static
    {
        if (!$this->rendezvouses->contains($rendezvouse)) {
            $this->rendezvouses->add($rendezvouse);
            $rendezvouse->setMedecin($this);
        }

        return $this;
    }

    public function removeRendezvouse(Rendezvous $rendezvouse): static
    {
        if ($this->rendezvouses->removeElement($rendezvouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezvouse->getMedecin() === $this) {
                $rendezvouse->setMedecin(null);
            }
        }

        return $this;
    }
    public function __toString()
{
    return $this->fullname; // Supposons que "name" est le nom de l'auteur que vous voulez afficher.
}
public function __toString1()
{
    return $this->specialite; // Supposons que "name" est le nom de l'auteur que vous voulez afficher.
}

public function getFullname(): ?string
{
    return $this->fullname;
}

public function setFullname(string $fullname): static
{
    $this->fullname = $fullname;

    return $this;
}
}
