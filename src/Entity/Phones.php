<?php

namespace App\Entity;

use App\Repository\PhonesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PhonesRepository::class)
 */
class Phones
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("getPhones")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=90)
     * @Groups("getPhones")
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
    private $model;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups("getPhones")
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
    private $brand;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups("getPhones")
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
    private $color;

    /**
     * @ORM\Column(type="float")
     * @Groups("getPhones")
     * @Assert\Type(
     *     type="double",
     *     message="La valeur {{ value }} n'est pas de type {{ type }}."
     * )
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
