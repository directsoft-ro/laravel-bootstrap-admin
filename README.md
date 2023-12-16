# Laravel Bootstrap Admin

### Install

```sh
composer require directsoft-ro/laravel-bootstrap-admin
```

```sh
php artisan vendor:publish --provider="DirectsoftRo\LaravelBootstrapAdmin\Providers\AdminServiceProvider"
```

Add admin domain name to .env

```dotenv
ADMIN_DOMAIN=admin.laravel.test
```

Add service provider to config

```php
// config/app.php
DirectsoftRo\LaravelBootstrapAdmin\Providers\AdminServiceProvider::class
```
