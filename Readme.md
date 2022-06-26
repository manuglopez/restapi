
# Rest API
![Testing](https://github.com/manuglopez/restapi/actions/workflows/symfony.yml/badge.svg)
![PHPStan](https://img.shields.io/badge/PHPStan-Level%205-brightgreen)

Para realizar este proyecto se ha usado symfony 5.4.
## Project Setup
Se ha usado el setup webapp de symfony en la version lt, que actualmente es 5.4.

Como base he utilizado SQlite, debido a que es rápida, es un solo archivo y es sencillamente perfecta para desarrollo.

He usado Doctrine como ORM que se integra con Symfony




### Bundles instalados

- **Api Platform:** Usado para generar api resources rápidamente se pueden.
- **Maker Bundle:** Usado para generar código en Symfony.

### Otros Paquetes

        "dama/doctrine-test-bundle": "^7.1",
        "doctrine/doctrine-fixtures-bundle": "^3.4",
        "fakerphp/faker": "^1.19",
        "nelmio/alice": "^3.10",
        "phpstan/phpstan": "^1.7",
        "phpunit/phpunit": "^9.5",
        "zenstruck/foundry": "^1.20"

Todos estos packages en la sección dev de composer se han usado como utilidades para generación de datos, o bien para mantener la Base de Datos en un estado determinado como Dama, o PhpStan  que se ha logrado un nivel 5 sin errores.

La autenticación por token se hace con jwt y el package Lexik-Jwt

# Intalación de la app

Después de clonar el repositorio. Debe crear un archivo en la raiz **.env**

Copie la sección de abajo en su archivo .env 

### Configuración mínima requerida para ejecutar la app.
```
APP_ENV=dev
APP_SECRET=2ca64f8d83b9e89f5f19d672841d6bb8
DATABASE_URL=sqlite:///%kernel.project_dir%/var/database.sqlite
CORS_ALLOW_ORIGIN=*
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=671309b9b844c31f1cd38a66d3c4c37c
```

```
php composer install
```
Prepare la Base de datos:
```
php bin/console doctrine:database:create

php bin/console doctrine:schema:create

php bin/console  doctrine:fixtures:load
```



# Set up for testing
Must prepare Database Settings before test run:

```shell
php bin/console --env=test doctrine:database:create

php bin/console --env=test doctrine:schema:create

php bin/console --env=test doctrine:fixtures:load
```

## Extra

He intentado crear un workflow específico para pasar los test en Github, pero sin suerte, xq no logro que la generación de certificados necesarios para los jwt tokens se creen. *(wip)*



## Valoración Personal.

He tardado mucho en realizar este project, no por la dificultad, sino porque no tengo experiencia con symfony, y estoy constantemente acudiendo a la ayuda de symfony y a la web en busca de soluciones a problemas propios de no conocer el framework.

Ejemplo. Sé que symfony tienen un contenedor de dependencias, pero hasta descubrir el comando `debug:container` me llevo alguna lectura. Pero entonces no sé como acceder al contenedor y necesito acceder desde un Test. Vuelta a la ayuda y a leer como se llaman servicios desde los test y que tipos hay etc.

En fin ha sido un crash course en symfony, pero he descubierto lo mucho que hace con lo poco que hay que escribir, es muy potente, tan potente que me ha enamorado.

Me he suscrito a SymfonyCasts durante un año sin pensarlo. Quiero destripar este Framework.


