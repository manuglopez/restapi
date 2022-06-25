# Set up for testing
Must prepare Database Settings before test run:
```shell
php bin/console --env=test doctrine:database:create

php bin/console --env=test doctrine:schema:create

php bin/console --env=test doctrine:fixtures:load
```
