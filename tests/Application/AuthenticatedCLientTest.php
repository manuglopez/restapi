<?php

namespace App\Tests\Application;


use App\Tests\JwtApiTestCase;

class AuthenticatedCLientTest extends JwtApiTestCase
{

    public function testPostProductListing()
    {
        $credentials = [
            'email' => 'mglopez@me.com',
            'password' => 'manuel'
        ];
        $jwtToken = self::createJwtToken($credentials);

        $product = json_encode([
            "name" => "Test Product",
            "description" => "Test Description",
            "priceWithoutIva" => 100,
            "tipoDeIva" => "/api/tipo_de_ivas/1" // superreducido
        ], JSON_THROW_ON_ERROR);

        $client = static::createClient();

        $response = $client->request('POST', 'https://127.0.0.1:8000/api/product_listings.jsonld',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $jwtToken
                ],
                'body' => $product
            ]
        );
        self::assertResponseIsSuccessful();

        self::assertJsonContains([
            "@context" => "/api/contexts/ProductListing",
            "@id" => "/api/product_listings/131",
            "@type" => "ProductListing",
            "name" => "Test Product",
            "description" => "Test Description",
            "priceWithoutIva" => 100,
            "tipoDeIva" => "/api/tipo_de_ivas/1"
        ]);
    }
}
