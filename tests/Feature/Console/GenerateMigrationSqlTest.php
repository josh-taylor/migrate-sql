<?php

namespace Joshtaylor\MigrateSql\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Joshtaylor\MigrateSql\Tests\TestCase;

class GenerateMigrationSqlTest extends TestCase
{
    /** @test */
    function it_can_generate_the_sql_of_a_create_up_migration()
    {
        Artisan::call('migrate:sql', [
            '--migration' => '2018_05_16_000000_create_stub_table',
            '--path' => realpath(__DIR__.'/../../stubs/migrations'),
            '--realpath' => true,
        ]);

        $output = Artisan::output();

        $this->assertContains(
            'create table `stub`',
            $output
        );
    }

    /** @test */
    function it_can_generate_the_sql_of_a_drop_table_down_migration()
    {
        Artisan::call('migrate:sql', [
            '--migration' => '2018_05_16_000000_create_stub_table',
            '--path' => realpath(__DIR__.'/../../stubs/migrations'),
            '--realpath' => true,
            '--down' => true,
        ]);

        $output = Artisan::output();

        $this->assertContains(
            'drop table if exists `stub`',
            $output
        );
    }

    /** @test */
    function it_displays_a_list_of_all_migrations_when_the_migration_option_is_not_specified()
    {
        Artisan::call('migrate:sql', [
            '--path' => realpath(__DIR__.'/../../stubs/migrations'),
            '--realpath' => true,
        ]);

        $output = Artisan::output();

        $this->assertContains(
            '2018_05_16_000000_create_stub_table',
            $output
        );
    }
}
