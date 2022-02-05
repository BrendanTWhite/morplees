<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Filament\Resources\Pages\CreateFilamentRecord;

class CreateProduct extends CreateFilamentRecord
{
    protected static string $resource = ProductResource::class;

	protected function mutateFormDataBeforeCreate(array $data): array
	{
	    $data['family_id'] = auth()->user()->family_id;
	    return $data;
	}

}
