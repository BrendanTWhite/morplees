<?php

namespace App\Actions\DatabaseMask;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MaskModel
{

    const CHUNK_SIZE = 10;

    public function __invoke(string $model, Command $command)
    {
        $model_count = $model::count();
        $chunk_count =  1 + intdiv($model_count-1, self::CHUNK_SIZE);

        $command->line("$model");
       // $command->debug("in $chunk_count chunks of up to {self::CHUNK_SIZE}");

        $progressBar = $command->getOutput()->createProgressBar($chunk_count);
        $progressBar->setFormat('%bar%');

        // get all of this model from the database in chunks https://laravel.com/docs/9.x/eloquent#chunking-results
        $model::chunk(self::CHUNK_SIZE, function($theChunk) use ($progressBar){
            
            usleep(300000);

            $progressBar->advance();
        }
    );

        // for this batch of N records:

        // Create N fake records
        // If we have no Faker for this model, return a warning and then continue with the next model

        // From the fake records, keep ONLY the fields we need to mask https://laravel.com/docs/9.x/collections#method-only

        // MERGE the fake data in to the real data https://laravel.com/docs/9.x/collections#method-merge

        // save the N records to the database

        $progressBar->finish();
        $command->newLine(2);

    }

}
