<?php

namespace Workbench\App\Providers;

use Illuminate\Support\ServiceProvider;
use Schmeits\Pulse\DatabaseTableInfo\Recorders\TableInfoRecorder;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        config(['pulse.recorders' => [
            TableInfoRecorder::class => [
                'enabled' => true,
                'show_fragmentation' => true,
                'ignore' => [
                    '#^test123#',
                ],
            ],
        ]]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
