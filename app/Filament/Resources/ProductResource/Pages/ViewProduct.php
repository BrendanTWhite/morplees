<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Actions;
use Filament\Notifications\Notification;
use App\Models;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    //protected static string $view = 'filament.resources.product-resource.pages.view-product';


    protected function getActions(): array
    {
        return [
            Actions\Action::make('add_to_list')->label('Add to Shopping List')
            ->action('addToList'),

            Actions\EditAction::make(),
        ];
    }
     

    public function addToList(): void
    {
        $product = $this->record;
        $shoppingList = Models\ShoppingList::getActiveSL();

        Models\SLItem::create([
            'product_id' => $product->id,
            'shopping_list_id' => $shoppingList->id,
        ]);
        
        Notification::make() 
            ->title($product->name . ' added to list')
            ->success()
            ->send(); 
    }


}
