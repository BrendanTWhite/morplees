<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ProductButton extends Widget
{
    protected static string $view = 'filament.widgets.product-button';
    protected int | string | array $columnSpan = 1;
}
