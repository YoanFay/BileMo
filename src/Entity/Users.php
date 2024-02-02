<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Annotations\Property;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 *
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "detailUser",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups="getUsers")
 * )
 *
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "deleteUsers",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups="getUsers"),
 * )
 *
 * @Hateoas\Relation(
 *      "update",
 *      href = @Hateoas\Route(
 *          "updateUser",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups="getUsers"),
 * )
 *
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"getUsers", "getCustomers"})
     * @var int
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"getUsers", "getCustomers"})
     * @Assert\NotBlank(message = "Le prénom est obligatoires")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre prénom doit comporter au moins {{ limit }} caractères.",
     *      maxMessage = "Votre prénom ne peut pas contenir plus de {{ limit }} caractères."
     * )
     * @Property(description="Prénom de l'utilisateur")
     * @Serializer\Expose
     */
    private ?string $firstname = null;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"getUsers", "getCustomers"})
     * @Assert\NotBlank(message = "Le nom est obligatoires")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre nom de famille doit comporter au moins {{ limit }} caractères.",
     *      maxMessage = "Votre nom de famille ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Property(description="Nom de l'utilisateur")
     */
    private ?string $lastname = null;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getUsers", "getCustomers"})
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
    private ?string $email = null;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getUsers", "getCustomers"})
     * @Assert\NotBlank(message = "L'adresse est obligatoire")
     * @Assert\Length(
     *      min = 6,
     *      max = 100,
     *      minMessage = "L'adresse doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "L'adresse ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Property(description="Adresse de l'utilisateur")
     */
    private ?string $address = null;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"getUsers", "getCustomers"})
     * @Assert\NotBlank(message = "La ville est obligatoire")
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     *      minMessage = "La ville doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "La ville ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Property(description="Ville de l'utilisateur")
     */
    private ?string $city = null;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"getUsers", "getCustomers"})
     * @Assert\NotBlank(message = "Le code postal est obligatoire")
     * @Property(description="Code postal de l'utilisateur")
     */
    private ?int $zipcode = null;

    /**
     * @ORM\ManyToOne(targetEntity=Customers::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"getUsers"})
     * @Property(description="Client lié à l'utilisateur")
     */
    private Customers $customer;


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
     * @return string|null
     */
    public function getAddress(): ?string
    {

        return $this->address;
    }


    /**
     * @param string $address parameter
     *
     * @return $this
     */
    public function setAddress(string $address): self
    {

        $this->address = $address;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getCity(): ?string
    {

        return $this->city;
    }


    /**
     * @param string $city parameter
     *
     * @return $this
     */
    public function setCity(string $city): self
    {

        $this->city = $city;

        return $this;
    }


    /**
     * @return int|null
     */
    public function getZipcode(): ?int
    {

        return $this->zipcode;
    }


    /**
     * @param int $zipcode parameter
     *
     * @return $this
     */
    public function setZipcode(int $zipcode): self
    {

        $this->zipcode = $zipcode;

        return $this;
    }


    /**
     * @return Customers
     */
    public function getCustomer(): Customers
    {

        return $this->customer;
    }


    /**
     * @param Customers $customer parameter
     *
     * @return $this
     */
    public function setCustomer(Customers $customer): self
    {

        $this->customer = $customer;

        return $this;
    }
}
