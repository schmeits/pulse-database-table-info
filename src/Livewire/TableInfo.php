<?php

namespace Schmeits\Pulse\DatabaseTableInfo\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;
use Laravel\Pulse\Facades\Pulse;
use Laravel\Pulse\Livewire\Card;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;
use Schmeits\Pulse\DatabaseTableInfo\Recorders\TableInfoRecorder;

#[Lazy]
class TableInfo extends Card
{
    #[Url(as: 'table-info')]
    public string $orderBy = 'size';

    public array $sort_options = [
        'size' => 'size',
        'rows' => 'rows',
        'name' => 'name',
        'fragmentation' => 'fragmentation',
    ];

    public function render(): View
    {
        [$value] = $this->remember(
            function () {
                $results_from_recorder = Pulse::values('database-tables-info', ['result']);

                if ($results_from_recorder->isEmpty()) {
                    return collect();
                }

                return collect(json_decode($results_from_recorder->first()->value));
            }
        );

        $value = match (true) {
            $this->orderBy === 'size' => $value->sortByDesc('size'),
            $this->orderBy === 'rows' => $value->sortByDesc('rows'),
            default => $value->sortBy('name')
        };

        return view('pulse-database-table-info::livewire.table-info', [
            'results' => $value ?? collect(),
            'show-fragmentation' => Config::get('pulse.recorders.'.TableInfoRecorder::class.'.show_fragmentation', false),
        ]);
    }
}
