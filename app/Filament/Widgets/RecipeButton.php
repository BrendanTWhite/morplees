<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class RecipeButton extends Widget
{
    protected static string $view = 'filament.widgets.recipe-button';

    protected int | string | array $columnSpan = 2;
}
