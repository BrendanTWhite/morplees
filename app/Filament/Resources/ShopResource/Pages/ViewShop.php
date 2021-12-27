<?php

namespace App\Filament\Resources\ShopResource\Pages;

use App\Filament\Resources\ShopResource;
use Filament\Resources\Pages\Page;

class ViewShop extends Page
{
    protected static string $resource = ShopResource::class;

    protected static string $view = 'filament.resources.shop-resource.pages.view-shop';
}
