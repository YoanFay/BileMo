<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity(fields={"email"}, message="L'email {{ value }} est déjà utilisé")
 * @ORM\Entity(repositoryClass=CustomersRepository::class)
 */
class Customers implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("getCustomers", "getUsers")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("getCustomers", "getUsers")
     * @Assert\NotBlank(message = "L'email est obligatoire")
     * @Assert\Email(message = "L'e-mail '{{ value }}' n'est pas un e-mail valide.")
     * @Assert\Length(
     *      min = 6,
     *      max = 180,
     *      minMessage = "Votre e-mail doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "Votre e-mail ne peut pas comporter plus de {{ limit }} caractères."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("getCustomers", "getUsers")
     * @Assert\NotBlank(message = "Les rôles sont obligatoires")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups("getCustomers", "getUsers")
     * @Assert\NotBlank(message = "Le mot de passe est obligatoires")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("getCustomers", "getUsers")
     * @Assert\NotBlank(message = "Le prénom est obligatoires")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre prénom doit comporter au moins {{ limit }} caractères.",
     *      maxMessage = "Votre prénom ne peut pas contenir plus de {{ limit }} caractères."
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("getCustomers", "getUsers")
     * @Assert\NotBlank(message = "Le nom est obligatoires")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre nom de famille doit comporter au moins {{ limit }} caractères.",
     *      maxMessage = "Votre nom de famille ne peut pas comporter plus de {{ limit }} caractères."
     * )
     */
    private $lastname;

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="customer")
     * @Groups("getCustomers")
     */
    private $users;


    public function __construct()
    {

        $this->users = new ArrayCollection();
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


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {

        return (string)$this->email;
    }


    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    /*public function getUsername(): string
    {

        return (string)$this->email;
    }*/


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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {

        return null;
    }


    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {

        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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


    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {

        return $this->users;
    }


    public function addUser(Users $user): self
    {

        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCustomer($this);
        }

        return $this;
    }


    public function removeUser(Users $user): self
    {

        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCustomer() === $this) {
                $user->setCustomer(null);
            }
        }

        return $this;
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {

        return $this->getUserIdentifier();
    }
}
