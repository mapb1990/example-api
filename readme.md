## Requirements

- PHP 5.6
- [Composer](https://getcomposer.org)

## Install

1. Execute the following commands:

```
mkdid webapp
cd webapp
git clone git@github.com:mapb1990/swordhealth.git .
composer install
```

2. Update ```.env``` file

3. Execute the following command: ```php artisan app:install```

## Update 

```
cd webapp
git pull
composer update
php artisan app:refresh
```

## Execute locally

1. Execute the following commands:

```
cd webapp
php artisan serve
```

2. Open ```localhost:8000``` in browser
