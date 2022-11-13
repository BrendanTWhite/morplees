<?php

namespace App\Filament\Resources\FamilyResource\Pages;

use App\Filament\Resources\FamilyResource;
use Filament\Resources\Pages\ViewRecord;

class ViewFamily extends ViewRecord
{
    protected static string $resource = FamilyResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['ical_url'] = url('/calendar/' . $data['ical_uuid'] . '.ics');
     
        return $data;
    }

}
