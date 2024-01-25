<?php

namespace Schmeits\PulseDatabaseTableSizes;

use Illuminate\Foundation\Application;
use Livewire\LivewireManager;
use Schmeits\PulseDatabaseTableSizes\Livewire\TableSizes;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PulseDatabaseTableSizesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('pulse-database-table-sizes')
            ->hasViews();
    }

    public function packageBooted(): void
    {
        $this->callAfterResolving('livewire', function (LivewireManager $livewireManager, Application $app) {
            $livewireManager->component('pulse.table-sizes', TableSizes::class);
        });
    }
}
