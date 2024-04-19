<?php

namespace Workbench\Database\Seeders;

use Illuminate\Database\Seeder;
use Orchestra\Testbench\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFactory::new()->create([
            'name' => 'Tally Schmeits',
            'email' => 'tally@schmeits.com',
        ]);
    }
}
