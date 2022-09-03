<?php

namespace App\Console\Commands\DatabaseMask;

use Illuminate\Console\Command;
use Spatie\DbSnapshots\SnapshotRepository;
use Illuminate\Support\Facades\App;

class Restore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbm:restore {filename? : The backup file to restore}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore database (and mask sensitive data with Faker)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Running DatabaseMask Restore");

        $environment = App::environment();
        if ($environment == 'production') {
                $this->info("DBM will not restore to a '$environment' environment.");
                return Command::INVALID;
        } 
         
        $this->warn("You are restoring to a '$environment' environment.");
        if (!$this->confirm('Do you wish to continue?')) {
            $this->info('Restore cancelled.');
            return Command::SUCCESS;
        }
         
        // If we don't have a filename specified, give the user a list to choose from

        $filename = $this->argument('filename');
        if (!$filename) {
            $this->line('Retreiving list of backups...');
            $list_of_backups = app(SnapshotRepository::class)->getAll();
            $this->line('... list retrived.');

            if ($list_of_backups->isEmpty()) {
                $this->warn('No backups found.');
                $this->warn('Run `php artisan dbm:backup` from your production environment to create a backup.');
                return Command::INVALID;
            }

            define("MOST_RECENT_BACKUP", 0);
            $filename = $this->choice(
                'Which backup should we restore?',
                $list_of_backups->pluck('name')->all(),
                MOST_RECENT_BACKUP
            );

            dd($filename);
        }








        $useLatestSnapshot = $this->option('latest') ?: false;

        $name = $useLatestSnapshot
            ? $backups->first()->name
            : ($this->argument('name') ?: $this->askForSnapshotName());

        /** @var \Spatie\DbSnapshots\Snapshot $snapshot */
        $snapshot = app(SnapshotRepository::class)->findByName($name);

        if (! $snapshot) {
            $this->warn("Snapshot `{$name}` does not exist!");

            return Command::INVALID;
        }

        if ($this->option('stream') ?: false) {
            $snapshot->useStream();
        }

        $snapshot->load($this->option('connection'), (bool) $this->option('drop-tables'));

        $this->info("Snapshot `{$name}` loaded!");

















        return Command::SUCCESS;
    }
}
