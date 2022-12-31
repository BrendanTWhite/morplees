<?php

namespace App\Filament\Resources\Pages;

use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;

class EditMorpleesRecord extends EditRecord
{
    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record->id]);
    }


    protected function getFormActions(): array
    {
        return [

            Actions\DeleteAction::make(),

            Actions\Action::make('delete')
                ->action('delete'),
    
        ];
    }


    protected function getActions(): array
    // Action buttons at the top
    {

        return [ 
            Actions\DeleteAction::make(),
            $this->getSaveFormAction(),
            $this->getCancelFormAction(),
        ];

    }

}
