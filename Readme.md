# Rest API 

Para realizar este proyecto se ha usado symfony 5.4, debido a que ciertos bundles usados aun no est'an actualizados a la versi'on 6 de symfony

## Project Setup
Se ha usado el skeleton de symfony para tener bajo control los paquetes instalados e instalando posteriormente s'olo aquellas funcionalidades 
necesarias para el desarrollo de la aplicaci'on.

Como base de datos se usar'a SQlite, es 'un s'olo archivo y permite hacer el mismo trabajo que otros sistemas mucho m'as pesados.


### Bundles instalados

   - **Api Platform:**  Usado para generar api resources r'apidamente se pueden desarollar apis de forma muy r'apida.
   - **Maker Bundle:**  Usado para generar c'odigo r'apidamente.

### Otros Paquetes

```php
composer require fakerphp/faker
```
Para generar datos con fixtures 