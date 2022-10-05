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

use Psr\Log\LoggerInterface;

class MaskDatabase
{


    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function maskAllModels(){

        Log::debug("  --- starting masking");

        // first, get all models
        $allModels = self::getModels();

        // start with empty collections for missing, empty, and populated $masked value
        $modelsMissingMaskedFields = $modelsWithEmptyMaskedFields = $modelsWithPopulatedMaskedFields = Collect();

        foreach($allModels as $thisModel){

            $reflection = new \ReflectionClass($thisModel);
            $defaultProperties = $reflection->getDefaultProperties();             
            
            if (!array_key_exists( 'masked',  $defaultProperties)) {
                Log::debug($thisModel.' - MISSING!!!');
            } else {
                $masked = $defaultProperties['masked']; 

                if ($masked){
                    Log::debug($thisModel.' - '.implode('/',$masked));
                } else {
                    Log::debug($thisModel.' (empty) ');                    
                }
            }        

            // Log::debug("ending model $thisModel");

            } // next model

        // then, for each *empty* one, just log as empty / NFA
        // then, for each *missing* one, log as missing / problem
        // then, for each with contents, mask records for that model
        

    }

    public static function getModels(): Collection
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
