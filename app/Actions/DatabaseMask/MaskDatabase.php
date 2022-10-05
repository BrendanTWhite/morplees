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

use App\Actions\DatabaseMask\MaskModel;

class MaskDatabase
{

    public function __invoke(Command $command){

        // first, get all models
        $allModels = self::getModels();

        // start with empty collections for missing, empty, and populated $masked value
        $modelsMissingMaskedFields = Collect();
        $modelsWithEmptyMaskedFields = Collect();
        $modelsWithPopulatedMaskedFields = Collect();

        foreach($allModels as $thisModel){

            $reflection = new \ReflectionClass($thisModel);
            $defaultProperties = $reflection->getDefaultProperties();             
            
            if (!array_key_exists( 'masked',  $defaultProperties)) {
                // The 'masked' field is mising.
                $modelsMissingMaskedFields->push($thisModel);

            } else {

                // Get the 'maksed' property
                $masked = $defaultProperties['masked']; 

                if ($masked && is_array($masked)){
                    // It's an array, and it's populated
                    $modelsWithPopulatedMaskedFields->push($thisModel);

                } else {
                    // It's not an array, or it's not populated
                    $modelsWithEmptyMaskedFields->push($thisModel);     

                }
            }        

            } // next model

        // then, for each with contents, mask records for that model
        if($modelsWithPopulatedMaskedFields) {
            $modelCount = $modelsWithPopulatedMaskedFields->count();
            $modelsString = implode(', ', $modelsWithPopulatedMaskedFields->all());
            $command->info("$modelCount models to Mask: $modelsString");    

            foreach($modelsWithPopulatedMaskedFields as $thisModel){
                $maskModel = new MaskModel();
                $maskModel($thisModel, $command);
            }
        }

        // then, for each *empty* one, just log as empty / NFA
        if($modelsWithEmptyMaskedFields) {
            $modelCount = $modelsWithEmptyMaskedFields->count();
            $modelsString = implode(', ', $modelsWithEmptyMaskedFields->all());
            $command->line("$modelCount models to skip: $modelsString");    
        }

        // then, for each *missing* one, log as missing / problem
        if($modelsMissingMaskedFields) {
            $modelCount = $modelsMissingMaskedFields->count();
            $modelsString = implode(', ', $modelsMissingMaskedFields->all());
            $command->warn("$modelCount MODELS NOT SPECIFIED: $modelsString");    
        }
        

    }

    public function getModels(): Collection
    // from https://stackoverflow.com/questions/34053585/how-do-i-get-a-list-of-all-models-in-laravel#answer-60310985
    {
        $models = collect(File::allFiles(app_path()))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                $class = sprintf('\%s%s',
                    Container::getInstance()->getNamespace(),
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\'));
    
                return $class;
            })
            ->filter(function ($class) {
                $valid = false;
    
                if (class_exists($class)) {
                    $reflection = new \ReflectionClass($class);
                    $valid = $reflection->isSubclassOf(Model::class) &&
                        !$reflection->isAbstract();
                }
    
                return $valid;
            });
    
        return $models->values();
    }




}
