<?php

namespace App\Filament\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;

class CreateMorpleesRecord extends CreateRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record->id]);
    }
}
