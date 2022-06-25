<?php

namespace App\Events\Listeners;

use App\Entity\ProductListing;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

class ProductListingPersisted
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    // the listener methods receive an argument which gives you access to
    // both the entity object of the event and the entity manager itself
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof ProductListing) {
            return;
        }

        $entityManager = $args->getObjectManager();

         // If product has not iva calculated and saves to database
         // This Listener is of utility in order to load fixtures when prices doe not have IVA
        if (!$entity->getPriceWithIva()) {
            $iva = 1 + ($entity->getTipoDeIva()->getValue() / 100.0);
            $priceWithIva = (int) $entity->getPriceWithoutIva() *  $iva;
            $entity->setPriceWithIva($priceWithIva);
            $this->logger->info("Precio con Iva: $priceWithIva has been modified");
            $entityManager->persist($entity);
        }

    }
}
