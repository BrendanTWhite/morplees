<?php

namespace App\Actions\DatabaseMask;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class MaskModel
{
    const CHUNK_SIZE = 5;

    public function __invoke(string $model, Command $command)
    {
        $command->line("Masking $model");

        // Check to see if we the model has a factory

        $model_count = $model::count();
        $chunk_count = 1 + intdiv($model_count - 1, self::CHUNK_SIZE);

        $progressBar = $command->getOutput()->createProgressBar($chunk_count);
        $progressBar->setFormat('%bar%');

        // From the model, determine which fields to mask
        $fieldsToMask = $this->getFieldsToMaskFrom($model);

        // Process all records from this model in chunks
        $model::chunk(self::CHUNK_SIZE, function ($chunk) use ($progressBar, $model, $fieldsToMask) {
            $this->maskChunk($chunk, $model, $fieldsToMask);
            $progressBar->advance();
        });

        $progressBar->finish();
        $command->newLine(2);
    }

    private function maskChunk($chunk, $model, $fieldsToMask)
    {
        // now loop through each record
        foreach ($chunk as $realRecord) {
            // create a (full) fake record
            $fakeRecord = $model::factory()->make();

            // and replace the appropriate fields on the real record with values from the fake one
            $realRecord->fill($fakeRecord->only($fieldsToMask))->save();
        }
    }

    private function getFieldsToMaskFrom(string $thisModel): array
    {
        $reflection = new \ReflectionClass($thisModel);
        $defaultProperties = $reflection->getDefaultProperties();
        $maskedFields = $defaultProperties['masked'];

        return $maskedFields;
    }
}
