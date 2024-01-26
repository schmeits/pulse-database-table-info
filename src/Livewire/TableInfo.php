<?php

namespace Schmeits\PulseDatabaseTableInfo\Livewire;

use Illuminate\Contracts\View\View;
use Laravel\Pulse\Facades\Pulse;
use Laravel\Pulse\Livewire\Card;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;

#[Lazy]
class TableInfo extends Card
{
    #[Url(as: 'table-sizes')]
    public string $orderBy = 'size';

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

        return view('pulse-database-table-sizes::livewire.table-info', [
            'results' => $value ?? collect(),
        ]);
    }
}
