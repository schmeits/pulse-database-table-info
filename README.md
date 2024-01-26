# A Laravel Pulse card displaying the table info of the current database.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/schmeits/pulse-database-table-info.svg?style=flat-square)](https://packagist.org/packages/schmeits/pulse-database-table-info)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/schmeits/pulse-database-table-info/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/schmeits/pulse-database-table-info/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/schmeits/pulse-database-table-info/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/schmeits/pulse-database-table-info/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/schmeits/pulse-database-table-info.svg?style=flat-square)](https://packagist.org/packages/schmeits/pulse-database-table-info)

This pulse card displays the tables in the database with their corresponding info (size and rows).

![example-screenshot.png](docs-assets%2Fscreenshots%2Fexample-screenshot.png)

## Installation

You can install the package via composer:

```bash
composer require schmeits/pulse-database-table-info
```

## Register the recorder

To run the checks you must add the `TableInfoRecorder` to the `pulse.php` file.

```diff
return [
    // ...
    
    'recorders' => [
+        \Schmeits\PulseDatabaseTableInfo\Recorders\TableInfoRecorder::class => [],
    ]
]
```

You also need to be running [the `pulse:check` command](https://laravel.com/docs/10.x/pulse#dashboard-cards).

## Add to your dashboard

To add the card to the Pulse dashboard, you must first [publish the vendor view](https://laravel.com/docs/10.x/pulse#dashboard-customization).

Then, you can modify the `dashboard.blade.php` file:

```diff
<x-pulse>
+    <livewire:pulse.table-info cols='4' rows='2' />

    <livewire:pulse.servers cols="full" />

    <livewire:pulse.usage cols="4" rows="2" />

    <livewire:pulse.queues cols="4" />

    <livewire:pulse.cache cols="4" />

    <livewire:pulse.slow-queries cols="8" />

    <livewire:pulse.exceptions cols="6" />

    <livewire:pulse.slow-requests cols="6" />

    <livewire:pulse.slow-jobs cols="6" />

    <livewire:pulse.slow-outgoing-requests cols="6" />

</x-pulse>
```

That's it :)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Tally Schmeits](https://github.com/schmeits)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
