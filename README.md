<p align="center"><img src="https://banners.beyondco.de/laravel-model-iid.png?theme=light&packageManager=composer+require&packageName=julianstark999%2Flaravel-model-iid&pattern=circuitBoard&style=style_2&description=&md=1&showWatermark=0&fontSize=100px&images=database&widths=350&heights=350" alt="Social Card of Laravel Model Iid"></p>

# Laravel Iid

Laravel Model Iid provides the functionality to have an autoincrement primary key and an iid column to display which is incremented by a defined $iidColumn

[![Latest Version on Packagist](https://img.shields.io/packagist/v/julianstark999/laravel-model-iid.svg?style=flat-square)](https://packagist.org/packages/julianstark999/laravel-model-iid)
[![Total Downloads](https://img.shields.io/packagist/dt/julianstark999/laravel-model-iid.svg?style=flat-square)](https://packagist.org/packages/julianstark999/laravel-model-iid)

## Installation

You can install the package via composer:

```bash
composer require julianstark999/laravel-model-iid
```

## Usage

### Model

```php
<?php


use JulianStark999\LaravelModelIid\Traits\HasIidColumn;


class Post extends Model
{
    use HasIidColumn;


    public $iidColumn = 'category_id';

    
    ...
}
```

### Migration

```php
$table->integer('iid')->nullable();

// optional
$table->unique(['category_id', 'iid']);
```

### Commands

#### iid:generate

The `iid:generate` command generates missing iids for existing models

```bash
php artisan iid:generate "App\Models\Post"
```

#### iid:init

The `iid:init` command initializes the iids for existing models by using the id column

```bash
php artisan iid:init "App\Models\Post"
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Julian Stark](https://github.com/julianstark999)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
