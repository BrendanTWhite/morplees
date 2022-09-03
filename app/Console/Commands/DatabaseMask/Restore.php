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
    protected $signature = 'dbm:restore';

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
        return 0;
    }
}
