<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

	protected function mutateFormDataBeforeCreate(array $data): array
	{
	    $data['family_id'] = auth()->user()->family_id;
	    return $data;
	}

}
