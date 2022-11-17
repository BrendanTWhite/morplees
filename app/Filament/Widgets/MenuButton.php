<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class MenuButton extends Widget
{
    protected static string $view = 'filament.widgets.menu-button';

    protected int | string | array $columnSpan = 2;
}
