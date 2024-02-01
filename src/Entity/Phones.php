<?php

namespace App\Entity;

use App\Repository\PhonesRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Annotations\Property;

/**
 * @ORM\Entity(repositoryClass=PhonesRepository::class)
 */
class Phones
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"getPhones"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=90)
     * @Groups({"getPhones"})
     * @Assert\Length(
     *      min = 2,
     *      max = 90,
     *      minMessage = "Le modèle doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "Le modèle ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Assert\Type(
     *     type="string",
     *     message="La valeur {{ value }} n'est pas de type {{ type }}."
     * )
     */
    private string $model;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"getPhones"})
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "La marque doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "La marque ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Assert\Type(
     *     type="string",
     *     message="La valeur {{ value }} n'est pas de type {{ type }}."
     * )
     */
    private string $brand;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups({"getPhones"})
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "La couleur doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "La couleur ne peut pas comporter plus de {{ limit }} caractères."
     * )
     * @Assert\Type(
     *     type="string",
     *     message="La valeur {{ value }} n'est pas de type {{ type }}."
     * )
     */
    private string $color;

    /**
     * @ORM\Column(type="float")
     * @Groups({"getPhones"})
     * @Assert\Type(
     *     type="double",
     *     message="La valeur {{ value }} n'est pas de type {{ type }}."
     * )
     */
    private float $price;


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
    public function getModel(): ?string
    {

        return $this->model;
    }


    /**
     * @param string $model parameter
     *
     * @return $this
     */
    public function setModel(string $model): self
    {

        $this->model = $model;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {

        return $this->brand;
    }


    /**
     * @param string $brand parameter
     *
     * @return $this
     */
    public function setBrand(string $brand): self
    {

        $this->brand = $brand;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getColor(): ?string
    {

        return $this->color;
    }


    /**
     * @param string $color parameter
     *
     * @return $this
     */
    public function setColor(string $color): self
    {

        $this->color = $color;

        return $this;
    }


    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {

        return $this->price;
    }


    /**
     * @param float $price parameter
     *
     * @return $this
     */
    public function setPrice(float $price): self
    {

        $this->price = $price;

        return $this;
    }


}
