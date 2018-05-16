<?php

namespace Joshtaylor\MigrateSql;

use Illuminate\Support\ServiceProvider;
use Joshtaylor\MigrateSql\Console\GenerateSqlMigration;

class MigrateSqlServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateSqlMigration::class,
            ]);
        }
    }
}
