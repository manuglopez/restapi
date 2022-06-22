<?php

namespace App\DataFixtures;

use App\Entity\TipoDeIva;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class B_TipoDeIvaFixtures extends Fixture
{
    public const TIPO_SUPER_REDUCIDO = 'tipo-1';
    public const TIPO_REDUCIDO = 'tipo-2';
    public const TIPO_NORMAL = 'tipo-3';

    public function load(ObjectManager $manager): void
    {
        $ivaSuperreducido = new TipoDeIva();
        $ivaSuperreducido->setName('super-reducido')
            ->setValue(4);
        $manager->persist($ivaSuperreducido);
        $manager->flush();
        $this->addReference(self::TIPO_SUPER_REDUCIDO, $ivaSuperreducido);

        $ivaReducido = new TipoDeIva();
        $ivaReducido->setName('reducido')
            ->setValue(10);
        $manager->persist($ivaReducido);
        $manager->flush();
        $this->addReference(self::TIPO_REDUCIDO, $ivaReducido);

        $ivaNormal = new TipoDeIva();
        $ivaNormal->setName('normal')
            ->setValue(21);
        $manager->persist($ivaNormal);
        $manager->flush();
        $this->addReference(self::TIPO_NORMAL, $ivaNormal);
    }
}
