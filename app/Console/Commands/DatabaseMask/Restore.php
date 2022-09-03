<?php

namespace App\Console\Commands\DatabaseMask;

use Illuminate\Console\Command;

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
        $filename = $this->argument('filename') ?? $this->ask('What filename?');
        $this->info("Running DatabaseMask's Restore from $filename!");

        return Command::SUCCESS;
    }
}
