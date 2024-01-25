# A Laravel Pulse card displaying the table sizes of the current database.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/schmeits/pulse-database-table-sizes.svg?style=flat-square)](https://packagist.org/packages/schmeits/pulse-database-table-sizes)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/schmeits/pulse-database-table-sizes/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/schmeits/pulse-database-table-sizes/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/schmeits/pulse-database-table-sizes/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/schmeits/pulse-database-table-sizes/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/schmeits/pulse-database-table-sizes.svg?style=flat-square)](https://packagist.org/packages/schmeits/pulse-database-table-sizes)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require schmeits/pulse-database-table-sizes
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="pulse-database-table-sizes-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="pulse-database-table-sizes-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="pulse-database-table-sizes-views"
```

## Usage

```php
$pulseDatabaseTableSizes = new Schmeits\PulseDatabaseTableSizes();
echo $pulseDatabaseTableSizes->echoPhrase('Hello, Schmeits!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tally Schmeits](https://github.com/schmeits)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
