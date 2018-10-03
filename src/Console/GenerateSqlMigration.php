<?php

namespace Joshtaylor\MigrateSql\Console;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\Console\Migrations\BaseCommand;

class GenerateSqlMigration extends BaseCommand
{
    protected $signature = 'migrate:sql 
                            {--migration= : Name of the migration.}
                            {--path= : The path to the migrations files to be executed.}
                            {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths.}
                            {--down : Generate the SQL for the down migration.}';

    protected $description = 'Dump the SQL query that would be run for a migration file.';

    protected $migrator;

    public function __construct()
    {
        parent::__construct();

        $this->migrator = app('migrator');
    }

    public function handle()
    {
        $migration = $this->migrator->resolve($name = $this->migrationName());

        $db = $this->migrator->resolveConnection($migration->getConnection());

        $method = $this->option('down') ? 'down' : 'up';

        $queries = $db->pretend(function () use ($migration, $method) {
            $migration->{$method}();
        });

        $this->output->writeln("<info>SQL to run '{$name}' {$method}:</info>");

        foreach ($queries as $query) {
            $this->output->writeln("{$query['query']}");
        }

        $this->copyQueriesToClipboard(array_pluck($queries, 'query'));
    }

    protected function migrationFiles()
    {
        $files = $this->migrator->getMigrationFiles(
            $this->getMigrationPaths()
        );

        $this->migrator->requireFiles($files);

        return $files;
    }

    protected function migrationName()
    {
        $files = $this->migrationFiles();

        if (!$name = $this->option('migration')) {
            return $this->choice('Choose a migration', array_keys($files), 0);
        }

        return $name;
    }

    protected function copyQueriesToClipboard($queries)
    {
        if (`which pbcopy`) {
            $queriesString = escapeshellarg(implode("\r\n", $queries));
            shell_exec("echo {$queriesString} | pbcopy");
            $this->info('Copied to clipboard!');
        }
    }
}
