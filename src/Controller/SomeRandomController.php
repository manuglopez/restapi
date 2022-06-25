<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class SomeRandomController
{
    // This controller is specifically made for phpstan who is complaining about its inexistence
    // But it is totally prescindible.
    // See Entity/TipoDeIva where is referenced to hide some functionalities

    public function __invoke(): Response
    {
        return new Response('El Gobierno no nos deja hacer estas cosas', 403);
    }
}
