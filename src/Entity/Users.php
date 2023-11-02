<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("getUsers", "getCustomers")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("getUsers", "getCustomers")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("getUsers", "getCustomers")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("getUsers", "getCustomers")
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     * @Groups("getUsers", "getCustomers")
     */
    private $zipcode;

    /**
     * @ORM\ManyToOne(targetEntity=Customers::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("getUsers")
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
