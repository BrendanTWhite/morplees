<?php

namespace App\Console\Commands\DatabaseMask;

use App\Services\DatabaseMask;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Spatie\DbSnapshots\Snapshot;
use Spatie\DbSnapshots\Helpers\Format;

class Backup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbm:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Database';

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
        $this->info('Running DatabaseMask Backup');

        // if we're backing up Production, that's great.
        // if we're backing up some other environment, check first.

        $environment = App::environment();
        if ($environment == 'production') {
                $this->info("You are backing up a '$environment' environment.");
        } else {
                $this->warn("You are backing up a '$environment' environment.");
                if (!$this->confirm('Do you wish to continue?')) {
                    $this->info('Backup cancelled.');
                    return Command::SUCCESS;
                }
        } 

        // OK. Now let's create this backup.

        $this->line('Starting backup...');
        $backup = DatabaseMask::backup();
        $this->line('... backup finished.');

        $size = Format::humanReadableSize($backup->size());
        
        $this->info("Successfully backed up this '$environment' environment to file '$backup->fileName' (size $size).");

        return Command::SUCCESS;
    }
}
