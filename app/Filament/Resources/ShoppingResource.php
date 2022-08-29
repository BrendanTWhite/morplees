<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShoppingResource\Pages;
use App\Filament\Resources\ShoppingResource\RelationManagers;
use App\Models;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ShoppingResource extends Resource
{
    protected static ?string $model = Models\SLItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Shopping';

    protected static ?string $label = 'Shopping List Item';
    protected static ?string $pluralLabel = 'Shopping List Items';
    protected static ?string $slug = 'shopping';

    protected static ?string $navigationGroup = 'Shopping Lists';
    public static ?int $navigationSort = 230;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\BooleanColumn::make('in_basket')
                    ->label('In Basket')
                    ->trueIcon('heroicon-o-check')
                    ->trueColor('success')
                    ->falseIcon('heroicon-o-minus-sm')
                    ->falseColor('secondary')
                    ->action(function (Models\SLItem $record): void {
                        $record->toggleInBasket();
                    }),

                Tables\Columns\TextColumn::make('product.name')->sortable()
                    ->url(
                        fn (Models\SLItem $record): string => 
                            route('filament.resources.products.view', ['record' => $record->product])
                    ),

                Tables\Columns\TextColumn::make('ingredient.quantity')->label('Qty'),

                Tables\Columns\TextColumn::make('product.shop_name')->label('Shop')->sortable(['name','shop_id'])
                    ->url(
                        fn (Models\SLItem $record): string => 
                            route('filament.resources.shops.view', ['record' => $record->product->shop])
                    ),
                                
                Tables\Columns\TextColumn::make('ingredient.recipe.name')->label('Recipe')
                    ->url(
                        fn (Models\SLItem $record): string => 
                            ($record->s_l_recipe)
                            ? route('filament.resources.recipes.view', ['record' => $record->s_l_recipe->recipe])
                            : ''
                    ),

            ])
            ->defaultSort('product.shop_name')
            ->actions([
                //
            ])              
            ->bulkActions([
                //
            ])   
            ;
    }



    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('shopping_list_id', Models\ShoppingList::getActiveSL()?->id)
            ->where('already_own', false)
            ->orderby('in_basket')
            ;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShoppings::route('/'),
            'create' => Pages\CreateShopping::route('/create'),
            'edit' => Pages\EditShopping::route('/{record}/edit'),
        ];
    }
    
}
