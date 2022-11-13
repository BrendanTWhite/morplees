<?php

namespace App\Filament\Resources\FamilyResource\Pages;

use App\Filament\Resources\FamilyResource;
use App\Filament\Resources\Pages\EditMorpleesRecord;

class EditFamily extends EditMorpleesRecord
{
    protected static string $resource = FamilyResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['ical_url'] = url('/calendar/' . $data['ical_uuid'] . '.ics');
     
        return $data;
    }

}
