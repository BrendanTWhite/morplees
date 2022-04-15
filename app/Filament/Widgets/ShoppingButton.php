<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ShoppingButton extends Widget
{
    protected static string $view = 'filament.widgets.shopping-button';
    protected int | string | array $columnSpan = 1;
}
