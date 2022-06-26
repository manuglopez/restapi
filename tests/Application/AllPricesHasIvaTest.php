<?php

namespace App\Tests\Application;

use App\Entity\ProductListing;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AllPricesHasIvaTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $em = $kernel->getContainer()->get('doctrine')->getManager();
        $product= (new ProductListing())
            ->setName('Product-test')
            ->setDescription('Description-test')
            ->setPriceWithoutIva(100)
            ->setTipoDeIva($em->getReference('App\Entity\TipoDeIva', '1'));// super-reducido
        $em->persist($product);
        $em->flush();

        $this->assertEquals(104, $product->getPriceWithIva());

    }
}
