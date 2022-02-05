<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\CreateFilamentRecord;

class CreateFilamentRecord extends CreateFilamentRecord
{

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('view',['record' => $this->record->id]);
    }

}