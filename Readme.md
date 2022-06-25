
# Rest API

Para realizar este proyecto se ha usado symfony 5.4, debido a que ciertos bundles usados aun no est'an actualizados a la versi'on 6 de symfony

## Project Setup
Se ha usado el setupo webapp de synfony en la version lt, que actualmente es 5.4.

Como base he utilizado SQlite,  debido a que es rápida, es un sólo archivo y es sencillamente perfecta para desarrollo.

He usado Doctrine como ORM que se integra con Symfony




### Bundles instalados

- **Api Platform:**  Usado para generar api resources rápidamente se pueden.
- **Maker Bundle:**  Usado para generar código en Symfony.

### Otros Paquetes

        "dama/doctrine-test-bundle": "^7.1",
        "doctrine/doctrine-fixtures-bundle": "^3.4",
        "fakerphp/faker": "^1.19",
        "nelmio/alice": "^3.10",
        "phpstan/phpstan": "^1.7",
        "phpunit/phpunit": "^9.5",
        "zenstruck/foundry": "^1.20"

Todos estos pakages en la sección dev de composer se han usado como utilidades para generacion de datos, o bien para mantener la Base de Datos en un estado determinado como Dama, o PhpStan  que se ha logrado un nivel 5 sin errores.

La stateless auth se hace con jwt y el package Lexik
```
Generate the SSL keys
$ php bin/console lexik:jwt:generate-keypair
Your keys will land in config/jwt/private.pem and config/jwt/public.pem (unless you configured a different path).

Available options:

--skip-if-exists will silently do nothing if keys already exist.
--overwrite will overwrite your keys if they already exist.
Otherwise, an error will be raised to prevent you from overwriting your keys accidentally.

Configuration
Configure the SSL keys path and passphrase in your .env:

JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=
```


## Extra

He intentado crear un workflow específico para pasar los test en Github, pero sin suerte, xq no logro que la generación de certificados necesarios para los jwt tokens se creen. *(wip)*



## Valoración Personal.

He tardado mucho en realizar este project, no por la dificultad, sino porque no tengo experiencia con symfony, y estoy constantemente acudiendo a la ayuda de symfony y a la web en busca de soluciones a problemas propios de no conocer el framework.

Ejemplo. Se que sympfony tienen un contenedor de dependencias, pero hasta descubrir el comando  debug:container me llevo alguna lectura. Pero entonces no se como acceder al contenedor y necesito acceder desde un Test. Vuelta a la ayuda y a leer como se llaman servicis desde los test y que tipos hay etc.

En fin ha sido un crash course en symfony, pero he descubierto lo mucho que hace con lo poco que hay que escribir, es muy potente, tan potente que me ha enamorado.

Me he suscrito a SymfonyCasts durante un año sin pensarlo. Quiero destirpar este Framework.

