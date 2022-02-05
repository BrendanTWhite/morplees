<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\CreateMorpleesRecord;

class CreateMorpleesRecord extends CreateMorpleesRecord
{

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('view',['record' => $this->record->id]);
    }

}