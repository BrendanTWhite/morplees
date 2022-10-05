<?php

namespace App\Actions\DatabaseMask;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Spatie\DbSnapshots\Helpers\Format;
use Spatie\DbSnapshots\SnapshotFactory;
use Spatie\DbSnapshots\Snapshot;
use Illuminate\Console\Command;
use Exception;
use Spatie\DbSnapshots\SnapshotRepository;
use Faker\Factory;
use Illuminate\Support\Facades\Log;


use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class MaskModel
{

    public function __invoke(String $model, Command $command){
        $command->line("Starting model $model");  




        // get all of this model from the database in chunks https://laravel.com/docs/9.x/eloquent#chunking-results

            // for this batch of N records:

                // Create N fake records
                    // If we have no Faker for this model, return a warning and then continue with the next model

                // From the fake records, keep ONLY the fields we need to mask https://laravel.com/docs/9.x/collections#method-only 

                // MERGE the fake data in to the real data https://laravel.com/docs/9.x/collections#method-merge

                // save the N records to the database




        $command->line("Finished model $model");  
    }

}
