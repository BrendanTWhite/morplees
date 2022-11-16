<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PantryResource\Pages;
use App\Models;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class PantryResource extends Resource
{
    protected static ?string $model = Models\SLItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';

    protected static ?string $navigationLabel = 'Pantry';

    protected static ?string $label = 'Pantry Check Item';

    protected static ?string $pluralLabel = 'Pantry Check Items';

    protected static ?string $slug = 'pantry';

    protected static ?string $navigationGroup = 'Shopping Lists';

    public static ?int $navigationSort = 220;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('ingredient.quantity')->label('Qty'),
                Tables\Columns\TextColumn::make('product.name')->sortable()
                    ->url(
                        fn (Models\SLItem $record): string => route('filament.resources.products.view', ['record' => $record->product])
                    ),

                Tables\Columns\BooleanColumn::make('already_own')
                    ->label('Got')
                    ->trueIcon('heroicon-o-check')
                    ->trueColor('success')
                    ->falseIcon('heroicon-o-minus-sm')
                    ->falseColor('secondary')
                    ->action(function (Models\SLItem $record): void {
                        $record->toggleAlreadyOwn();
                    }),

                Tables\Columns\TextColumn::make('ingredient.recipe.name')->label('Recipe')
                    ->url(
                        fn (Models\SLItem $record): string => ($record->s_l_recipe)
                            ? route('filament.resources.recipes.view', ['record' => $record->s_l_recipe->recipe])
                           : ''
                    ),

                Tables\Columns\TextColumn::make('product.shop_name')->label('Shop')->sortable(['name', 'shop_id'])
                    ->url(
                        fn (Models\SLItem $record): string => route('filament.resources.shops.view', ['record' => $record->product->shop])
                    ),

            ])
            ->defaultSort('product.shop_name')
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('shopping_list_id', Models\ShoppingList::getActiveSL()?->id);
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
            'index' => Pages\ListPantrys::route('/'),
            'create' => Pages\CreatePantry::route('/create'),
            //'edit' => Pages\EditPantry::route('/{record}/edit'),
        ];
    }
}
