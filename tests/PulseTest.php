<?php

use Illuminate\Support\Facades\App;
use Laravel\Pulse\Facades\Pulse;
use Laravel\Pulse\Support\CacheStoreResolver;
use Livewire\Livewire;
use Schmeits\Pulse\DatabaseTableInfo\Livewire\TableInfo;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('shows the table on the dashboard', function () {

    // clear the cache
    App::make(CacheStoreResolver::class)->store()->forget('laravel:pulse:'.TableInfo::class.'::1_hour');

    // fake table data
    $pulsedata = collect([
        ['name' => 'testtable2', 'size' => 98765, 'rows' => 12345],
        ['name' => 'test123', 'size' => 222222, 'rows' => 54321],
    ]);

    // send to pulse
    Pulse::set('database-tables-info', 'result', $pulsedata->toJson());

    Pulse::ingest();

    // assert
    Livewire::test(TableInfo::class, ['lazy' => false])
        ->assertStatus(200)
        ->assertSee(['testtable2', '96.45 KB', '12345'])
        ->assertSee(['test123', '217.014 KB', '54321']);

});
