<?php

namespace Schmeits\PulseDatabaseTableSizes;

use Schmeits\PulseDatabaseTableSizes\Commands\PulseDatabaseTableSizesCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PulseDatabaseTableSizesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pulse-database-table-sizes')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_pulse-database-table-sizes_table')
            ->hasCommand(PulseDatabaseTableSizesCommand::class);
    }
}
