How to run
---

Set database config in
```
app/config/parameters.yml
```
Run following commands

```
composer install 
php bin/console doctrine:schema:update --force
```

Go to path in browser

```
path/to/site/web/app_dev.php
```
e.g
```
localhost/event-form/web/app_dev.php
```