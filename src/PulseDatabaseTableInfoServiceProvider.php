<?php

namespace Schmeits\Pulse\DatabaseTableInfo;

use Illuminate\Foundation\Application;
use Livewire\LivewireManager;
use Schmeits\Pulse\DatabaseTableInfo\Livewire\TableInfo;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PulseDatabaseTableInfoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('pulse-database-table-info')
            ->hasViews();
    }

    public function packageBooted(): void
    {
        $this->callAfterResolving('livewire', function (LivewireManager $livewireManager, Application $app) {
            $livewireManager->component('pulse.table-info', TableInfo::class);
        });
    }
}
