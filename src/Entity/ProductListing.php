<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductListingRepository;
use Doctrine\ORM\Mapping as ORM;
#[ApiResource]
#[ORM\Entity(repositoryClass: ProductListingRepository::class)]
class ProductListing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\ManyToOne(targetEntity: TipoDeIva::class, inversedBy: 'productos')]
    #[ORM\JoinColumn(nullable: false)]
    private $tipoDeIva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTipoDeIva(): ?TipoDeIva
    {
        return $this->tipoDeIva;
    }

    public function setTipoDeIva(?TipoDeIva $tipoDeIva): self
    {
        $this->tipoDeIva = $tipoDeIva;

        return $this;
    }
}
