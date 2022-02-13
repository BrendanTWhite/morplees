<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\ButtonAction;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();
            return $resource::getUrl('view', ['record' => $record]);
        };
    }


    protected function getCreateButtonAction(): ButtonAction
    {
        $resource = static::getResource();
        //$label = $resource::getLabel();
		$label = $resource::getCreateButtonLabel();

        return ButtonAction::make('create')
            ->label(__('filament::resources/pages/list-records.actions.create.label', ['label' => $label]))
            ->url(fn () => $resource::getUrl('create'));
    }

}
