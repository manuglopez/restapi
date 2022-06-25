<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\SomeRandomController;
use App\Repository\TipoDeIvaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    itemOperations: [
        'get' => [
            'method' => 'GET',
            'controller' => SomeRandomController::class,
        ],
    ],
)]
#[ORM\Entity(repositoryClass: TipoDeIvaRepository::class)]
class TipoDeIva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /** @phpstan-ignore-next-line */
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[Groups('read')]
    #[ORM\Column(type: 'integer')]
    private $value;

    #[ORM\OneToMany(mappedBy: 'tipoDeIva', targetEntity: ProductListing::class)]
    private $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, ProductListing>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(ProductListing $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setTipoDeIva($this);
        }

        return $this;
    }

    public function removeProducto(ProductListing $producto): self
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getTipoDeIva() === $this) {
                $producto->setTipoDeIva(null);
            }
        }

        return $this;
    }
}
