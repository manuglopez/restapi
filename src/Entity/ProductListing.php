<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ProductListingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => 'read'],
        ],
        'post' => [
            'security' => "is_granted('ROLE_USER')",
            'normalization_context' => ['groups' => 'write'],
        ],
    ],
    denormalizationContext: ['groups' => ['write']],
    normalizationContext: ['groups' => ['read']],
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'partial'])]
#[ORM\Entity(repositoryClass: ProductListingRepository::class)]
class ProductListing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /** @phpstan-ignore-next-line */
    private $id;

    #[Groups(['read', 'write'])]
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $name;

    #[Groups(['read', 'write'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[Groups(['read', 'write'])]
    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThan(0)]
    private $priceWithoutIva;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $priceWithIva;

    #[Groups(['read', 'write'])]
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

    public function getPriceWithIva(): ?int
    {
        return $this->priceWithIva;
    }

    public function setPriceWithIva($priceWithIva): self
    {
        $this->priceWithIva = $priceWithIva;

        return $this;
    }

    #[Groups('read')] // <- MAGIC IS HERE, you can set a group on a method.
    public function getPrice(): float
    {
        $iva = $this->getTipoDeIva()->getValue();
        $precioSinIva = $this->getPriceWithoutIva();
        $precio = $precioSinIva * (1 + ($iva / 100.0));

        return round($precio / 100, 2, PHP_ROUND_HALF_UP);
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

    public function getPriceWithoutIva(): ?int
    {
        return $this->priceWithoutIva;
    }

    public function setPriceWithoutIva(int $priceWithoutIva): self
    {
        $this->priceWithoutIva = $priceWithoutIva;

        return $this;
    }
}
