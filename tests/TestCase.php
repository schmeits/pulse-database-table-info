<?php

namespace Schmeits\Pulse\DatabaseTableInfo\Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    //use DatabaseTransactions;
    use WithWorkbench;
}
