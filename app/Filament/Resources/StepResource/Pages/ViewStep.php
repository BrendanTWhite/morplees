<?php

namespace App\Filament\Resources\StepResource\Pages;

use App\Filament\Resources\StepResource;
use Filament\Resources\Pages\Page;

class ViewStep extends Page
{
    protected static string $resource = StepResource::class;

    protected static string $view = 'filament.resources.step-resource.pages.view-step';
}
