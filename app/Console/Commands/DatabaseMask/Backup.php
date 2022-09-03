<?php

namespace App\Console\Commands\DatabaseMask;

use Illuminate\Console\Command;
use App\Services\DatabaseMask;
use Illuminate\Support\Facades\App;

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

        $environment = App::environment();
        switch ($environment) {
            case 'production':
                $this->info("You are backing up a '$environment' environment.");
                DatabaseMask::backup();
                break;
            
            default:
                $this->warn("You are backing up a '$environment' environment.");
                if ($this->confirm('Do you wish to continue?')) {

                    $filename = DatabaseMask::backup();
                    $this->info("Successfully backed up this '$environment' environment to file '$filename'.");

                } else { // not confirmed
                    $this->info('Backup cancelled.');
                }
                break;
        } 

        return Command::SUCCESS;
    }
}
