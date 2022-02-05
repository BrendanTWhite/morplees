<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\EditFilamentRecord;

class EditFilamentRecord extends EditFilamentRecord
{

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('view',['record' => $this->record->id]);
    }

}