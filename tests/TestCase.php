<?php

namespace Joshtaylor\MigrateSql\Tests;

use Illuminate\Database\MigrationServiceProvider;
use Joshtaylor\MigrateSql\MigrateSqlServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            MigrationServiceProvider::class,
            MigrateSqlServiceProvider::class,
        ];
    }
}
