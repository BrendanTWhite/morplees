<?php

namespace App\Filament\Resources\StepResource\Pages;

use App\Filament\Resources\StepResource;
use Filament\Resources\Pages\ListRecords;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ListSteps extends ListRecords
{
    protected static string $resource = StepResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();
            return $resource::getUrl('view', ['record' => $record]);
        };
    }

}
