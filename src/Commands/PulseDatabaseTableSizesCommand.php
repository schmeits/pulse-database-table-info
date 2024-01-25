<?php

namespace Schmeits\PulseDatabaseTableSizes\Commands;

use Illuminate\Console\Command;

class PulseDatabaseTableSizesCommand extends Command
{
    public $signature = 'pulse-database-table-sizes';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
