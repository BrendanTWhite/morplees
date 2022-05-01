<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ShopButton extends Widget
{
    protected static string $view = 'filament.widgets.shop-button';
    protected int | string | array $columnSpan = 1;
}
