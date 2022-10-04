<?php

namespace App\Console\Commands\DatabaseMask;

use Illuminate\Console\Command;
use App\Services\DatabaseMaskService;
use Illuminate\Support\Facades\App;
use Exception;
use Illuminate\Support\Facades\Log;

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
    
        try {
            DatabaseMaskService::maskAllModels();
        } catch (Exception $exception) {
            $this->warn($exception->getMessage());
            return Command::INVALID;
        }

        // All done. The masking completed successfully. Let's tell the user.

        $environment = App::environment();
        $this->info("This `{$environment}` environment has been masked. OR WILL BE WHEN WE HAVE FINISHED BUILDING THIS!");

        return Command::SUCCESS;
    }
}
