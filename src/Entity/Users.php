<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Annotations\Property;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("getUsers", "getCustomers")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("getUsers", "getCustomers")
     * @Assert\NotBlank(message = "Le prénom est obligatoires")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre prénom doit comporter au moins {{ limit }} caractères.",
     *      maxMessage = "Votre prénom ne peut pas contenir plus de {{ limit }} caractères."
     * )
     * @Property(description="Prénom de l'utilisateur")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("getUsers", "getCustomers")
     * @Assert\NotBlank(message = "Le nom est obligatoires")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre nom de famille doit comporter au moins {{ limit }} caractères.",
     *      maxMessage = "Votre nom de famille ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Property(description="Nom de l'utilisateur")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("getUsers", "getCustomers")
     * @Assert\NotBlank(message = "L'email est obligatoire")
     * @Assert\Email(message = "L'e-mail '{{ value }}' n'est pas un e-mail valide.")
     * @Assert\Length(
     *      min = 6,
     *      max = 100,
     *      minMessage = "Votre e-mail doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "Votre e-mail ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Property(description="Email de l'utilisateur")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("getUsers", "getCustomers")
     * @Assert\NotBlank(message = "L'adresse est obligatoire")
     * @Assert\Length(
     *      min = 6,
     *      max = 100,
     *      minMessage = "L'adresse doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "L'adresse ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Property(description="Adresse de l'utilisateur")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("getUsers", "getCustomers")
     * @Assert\NotBlank(message = "La ville est obligatoire")
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     *      minMessage = "La ville doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "La ville ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Property(description="Ville de l'utilisateur")
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     * @Groups("getUsers", "getCustomers")
     * @Assert\NotBlank(message = "Le code postal est obligatoire")
     * @Property(description="Code postal de l'utilisateur")
     */
    private $zipcode;

    /**
     * @ORM\ManyToOne(targetEntity=Customers::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("getUsers")
     * @Property(description="Client lié à l'utilisateur")
     */
    private $customer;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCustomer(): ?Customers
    {
        return $this->customer;
    }

    public function setCustomer(?Customers $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
