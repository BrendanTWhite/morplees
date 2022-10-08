<?php

namespace App\Actions\DatabaseMask;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Throwable;

class MaskModel
{

    const CHUNK_SIZE = 10;

    public function __invoke(string $model, Command $command)
    {

        $command->line("$model");

        // Check to see if we the model has a factory


        $model_count = $model::count();
        $chunk_count = 1 + intdiv($model_count-1, self::CHUNK_SIZE);
        
        $progressBar = $command->getOutput()->createProgressBar($chunk_count);
        $progressBar->setFormat('%bar%');

        // try to process all of this model from the database in chunks 
        try {
        
            $model::chunk(self::CHUNK_SIZE, function($thisChunk) use ($progressBar, $model){
                    $this->maskChunk($thisChunk, $model);
                    $progressBar->advance();
                });

        } catch (Throwable $e) {
            //Log::info($e->__toString());
            return;
        } 

        $progressBar->finish();
        $command->newLine(2);

    }


    private function maskChunk($thisChunk, $model) {
        $chunkSize = $thisChunk->count();

        // Create N fake records
        $fakeRecords = $model::factory()->count($chunkSize)->make();

        // From the fake records, keep ONLY the fields we need to mask https://laravel.com/docs/9.x/collections#method-only

        // MERGE the fake data in to the real data https://laravel.com/docs/9.x/collections#method-merge

        // save the N records to the database


        usleep(100000);
    }

}
