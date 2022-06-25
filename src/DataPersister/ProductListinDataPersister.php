<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\ProductListing;
use Doctrine\ORM\EntityManagerInterface;

class ProductListinDataPersister implements DataPersisterInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data): bool
    {
        return $data instanceof ProductListing;
    }

    /**
     * @param ProductListing $data
     */
    public function persist($data): void
    {
        if (!$data->getPriceWithIva()) {
            $price = $data->getPriceWithoutIva() * (1 + ((float) $data->getTipoDeIva()->getValue() / 100.0));
            $data->setPriceWithIva($price);
        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
