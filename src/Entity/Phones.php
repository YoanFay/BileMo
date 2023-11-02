<?php

namespace App\Entity;

use App\Repository\PhonesRepository;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups("getPhones")
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups("getPhones")
     */
    private $color;

    /**
     * @ORM\Column(type="float")
     * @Groups("getPhones")
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
