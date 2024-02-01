<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Annotations as OA;

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
     * @Groups({"getCustomers", "getUsers"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"getCustomers", "getUsers"})
     * @Assert\NotBlank(message = "L'email est obligatoire")
     * @Assert\Email(message = "L'e-mail '{{ value }}' n'est pas un e-mail valide.")
     * @Assert\Length(
     *      min = 6,
     *      max = 180,
     *      minMessage = "Votre e-mail doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "Votre e-mail ne peut pas comporter plus de {{ limit }} caractères."
     * )
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"getCustomers", "getUsers"})
     * @Assert\NotBlank(message = "Les rôles sont obligatoires")
     * @OA\Property(type="array", @OA\Items(type="string"))
     * @var string[] $roles
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"getCustomers", "getUsers"})
     * @Assert\NotBlank(message = "Le mot de passe est obligatoires")
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"getCustomers", "getUsers"})
     * @Assert\NotBlank(message = "Le prénom est obligatoires")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre prénom doit comporter au moins {{ limit }} caractères.",
     *      maxMessage = "Votre prénom ne peut pas contenir plus de {{ limit }} caractères."
     * )
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"getCustomers", "getUsers"})
     * @Assert\NotBlank(message = "Le nom est obligatoires")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre nom de famille doit comporter au moins {{ limit }} caractères.",
     *      maxMessage = "Votre nom de famille ne peut pas comporter plus de {{ limit }} caractères."
     * )
     */
    private string $lastname;

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="customer")
     * @Groups({"getCustomers"})
     * @var ArrayCollection<int, Users>
     */
    private $users;


    /**
     *
     */
    public function __construct()
    {

        $this->users = new ArrayCollection();

    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {

        return $this->id;
    }


    /**
     * @param int $id parameter
     *
     * @return $this
     */
    public function setId(int $id): self
    {

        $this->id = $id;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {

        return $this->email;
    }


    /**
     * @param string $email parameter
     *
     * @return $this
     */
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
     * @see UserInterface
     */
    public function getRoles(): array
    {

        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }


    /**
     * @param string[] $roles parameter
     *
     * @return $this
     */
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


    /**
     * @param string $password parameter
     *
     * @return $this
     */
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


    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {

        return $this->firstname;
    }


    /**
     * @param string $firstname parameter
     *
     * @return $this
     */
    public function setFirstname(string $firstname): self
    {

        $this->firstname = $firstname;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {

        return $this->lastname;
    }


    /**
     * @param string $lastname parameter
     *
     * @return $this
     */
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


    /**
     * @param Users $user parameter
     *
     * @return $this
     */
    public function addUser(Users $user): self
    {

        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCustomer($this);
        }

        return $this;
    }


    /**
     * @param Users $user parameter
     *
     * @return $this
     */
    public function removeUser(Users $user): self
    {

        $this->users->removeElement($user);

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
