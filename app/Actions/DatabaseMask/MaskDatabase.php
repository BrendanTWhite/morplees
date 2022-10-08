<?php

namespace App\Actions\DatabaseMask;

use Illuminate\Console\Command;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Throwable;

class MaskDatabase
{
    public function __invoke(Command $command)
    {
        // first, get all models
        $allModels = self::getModels();

        // start with empty collections for different categories of model
        $modelsMissingMaskedFields = Collect();
        $modelsWithEmptyMaskedFields = Collect();
        $modelsWithNoFactory = Collect();
        $modelsToMask = Collect();

        foreach ($allModels as $thisModel) {
            $reflection = new \ReflectionClass($thisModel);
            $defaultProperties = $reflection->getDefaultProperties();

            if (! array_key_exists('masked', $defaultProperties)) {
                // The 'masked' field is mising.
                $modelsMissingMaskedFields->push($thisModel);
            } else {
                // Get the 'masked' property
                $masked = $defaultProperties['masked'];

                if (! is_array($masked) or ! $masked) {
                    // It's not an array, or it's an empty array
                    $modelsWithEmptyMaskedFields->push($thisModel);
                } else {
                    // Let's check if a factory exists
                    try {
                        $thisModel::factory();
                    } catch (Throwable $e) {
                        $modelsWithNoFactory->push($thisModel);

                        continue; // continue with the next model
                    }

                    // If we get this far, we can mask this model
                    $modelsToMask->push($thisModel);
                }
            }
        } // next model

        // For each model we can mask, go ahead and do it
        if ($modelsToMask->isNotEmpty()) {
            $modelCount = $modelsToMask->count();
            $modelsString = implode(', ', $modelsToMask->all());

            $command->info("$modelCount models to Mask: $modelsString");
            $command->newLine();

            foreach ($modelsToMask as $thisModel) {
                $maskModel = new MaskModel();
                $maskModel($thisModel, $command);
            }
        }

        // then, for each *empty* one, just log as empty / NFA
        if ($modelsWithEmptyMaskedFields->isNotEmpty()) {
            $modelCount = $modelsWithEmptyMaskedFields->count();
            $modelsString = implode(', ', $modelsWithEmptyMaskedFields->all());
            $command->line("$modelCount Models to skip: $modelsString");
        }

        // then, for each *missing* one, log as missing / problem
        if ($modelsMissingMaskedFields->isNotEmpty()) {
            $modelCount = $modelsMissingMaskedFields->count();
            $modelsString = implode(', ', $modelsMissingMaskedFields->all());
            $command->warn("$modelCount Models with mo 'masked' parameter specified: $modelsString");
        }

        // then, for model we want to mask but can't because we have no Factory, complain loudly
        if ($modelsWithNoFactory->isNotEmpty()) {
            $modelCount = $modelsWithNoFactory->count();
            $modelsString = implode(', ', $modelsWithNoFactory->all());
            $command->error("$modelCount Models with no Factory: $modelsString");
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
                        ! $reflection->isAbstract();
                }

                return $valid;
            });

        return $models->values();
    }
}
