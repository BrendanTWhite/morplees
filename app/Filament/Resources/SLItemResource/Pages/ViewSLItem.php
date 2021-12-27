<?php

namespace App\Filament\Resources\SLItemResource\Pages;

use App\Filament\Resources\SLItemResource;
use Filament\Resources\Pages\Page;

class ViewSLItem extends Page
{
    protected static string $resource = SLItemResource::class;

    protected static string $view = 'filament.resources.s-l-item-resource.pages.view-s-l-item';
}
