<?php

namespace App\Console\Commands\DatabaseMask;

use Illuminate\Console\Command;

class Mask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbm:mask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mask sensitive data with Faker';

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
        $this->info('Running DatabaseMask Mask');

        return Command::SUCCESS;
    }
}
