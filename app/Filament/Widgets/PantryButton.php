<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class PantryButton extends Widget
{
    protected static string $view = 'filament.widgets.pantry-button';
    protected int | string | array $columnSpan = 1;
}
