<?php

namespace App\Tests\Application;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ProductListingsTest extends ApiTestCase
{
    public function testProductList(): void
    {

        $response = static::createClient()->request('GET', 'https://127.0.0.1:8000/api/product_listings.jsonld', [
            'headers' => ['Content-Type' => 'application/json']
        ]);

        self::assertResponseIsSuccessful();
        self::assertJsonContains([
            "@context" => "/api/contexts/ProductListing",
            "@id" => "/api/product_listings",
            "@type" => "hydra:Collection",
            "hydra:member" => [],
            "hydra:totalItems" => 130,
            "hydra:search" => [
                "@type" => "hydra:IriTemplate",
                "hydra:template" => "/api/product_listings.jsonld{?name}",
                "hydra:variableRepresentation" => "BasicRepresentation",
                "hydra:mapping" => [
                    [
                        "@type" => "IriTemplateMapping",
                        "variable" => "name",
                        "property" => "name",
                        "required" => false
                    ]
                ]
            ]
        ]);

    }

    public function testProductListingPagination()
    {
        $response = static::createClient()->request('GET', 'https://127.0.0.1:8000/api/product_listings.jsonld?page=1',
            [
                'headers' => ['Content-Type' => 'application/json']
            ]);
        self::assertResponseIsSuccessful();
        self::assertJsonContains([
            "hydra:view" => [
                "@id" => "/api/product_listings.jsonld?page=1",
                "@type" => "hydra:PartialCollectionView",
                "hydra:first" => "/api/product_listings.jsonld?page=1",
                "hydra:last" => "/api/product_listings.jsonld?page=5",
                "hydra:next" => "/api/product_listings.jsonld?page=2"
            ]
        ]);
    }

    public function testProductListinCanBeFilteresByName()
    {
        $response = static::createClient()->request('GET',
            'https://127.0.0.1:8000/api/product_listings.jsonld?page=1&name=special',
            [
                'headers' => ['Content-Type' => 'application/json']
            ]);
        self::assertResponseIsSuccessful();
        self::assertJsonContains([
            "@context" => "/api/contexts/ProductListing",
            "@id" => "/api/product_listings",
            "@type" => "hydra:Collection",
            "hydra:totalItems" => 30,
        ]);
    }

    public function testUnauthenticatedUserCanNotInsertAProduct()
    {
        $product = json_encode([
            "name" => "Test Product",
            "description" => "Test Description",
            "priceWithoutIva" => 100,
            "tipoDeIva" => "/api/tipo_de_ivas/1" // superreducido
        ], JSON_THROW_ON_ERROR);


        $response = static::createClient()->request('POST', 'https://127.0.0.1:8000/api/product_listings.jsonld',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => $product
            ]
        );
        self::assertResponseStatusCodeSame(401,"JWT Token not found");
        self::assertResponseHasHeader('www-authenticate');
    }
}
