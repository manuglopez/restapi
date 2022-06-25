<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

class JwtApiTestCase extends ApiTestCase
{
    /**
     * @param array<string,string> $claims
     * @return string
     */
    protected static function createJwtToken(array $claims):string
    {
        static::bootKernel();
        return static::getContainer()->get('lexik_jwt_authentication.encoder')->encode($claims);
    }
}