<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\EditMorpleesRecord;

class EditMorpleesRecord extends EditMorpleesRecord
{

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('view',['record' => $this->record->id]);
    }

}