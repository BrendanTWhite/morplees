<?php

namespace App\Filament\Resources\Pages;

use Filament\Resources\Pages\EditRecord;

class EditFilamentRecord extends EditRecord
{

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('view',['record' => $this->record->id]);
    }

}