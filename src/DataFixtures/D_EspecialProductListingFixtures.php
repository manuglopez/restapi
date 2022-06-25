<?php

namespace App\DataFixtures;

use App\Entity\ProductListing;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class D_EspecialProductListingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Lets create a Spanish Faker
        $faker = Factory::create('es_ES');
        $tiposIva = [
            B_TipoDeIvaFixtures::TIPO_SUPER_REDUCIDO,
            B_TipoDeIvaFixtures::TIPO_REDUCIDO,
            B_TipoDeIvaFixtures::TIPO_NORMAL,
        ];
        for ($i = 0; $i < 30; ++$i) {
            $keryReferenceToIVA = array_rand($tiposIva);

            $product = new ProductListing();
            $product->setName('Special'.$i)
                ->setPriceWithoutIva($faker->randomNumber(3, true))
                ->setTipoDeIva($this->getReference($tiposIva[$keryReferenceToIVA]))
                ->setDescription($faker->text(250));
            $manager->persist($product);
            $manager->flush();
        }
    }
}
