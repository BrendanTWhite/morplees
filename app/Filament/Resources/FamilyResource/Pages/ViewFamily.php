<?php

namespace App\Filament\Resources\FamilyResource\Pages;

use App\Filament\Resources\FamilyResource;
use Filament\Resources\Pages\Page;

class ViewFamily extends Page
{
    protected static string $resource = FamilyResource::class;

    protected static string $view = 'filament.resources.family-resource.pages.view-family';
}
