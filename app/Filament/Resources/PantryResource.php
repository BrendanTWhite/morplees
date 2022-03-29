<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PantryResource\Pages;
use App\Filament\Resources\PantryResource\RelationManagers;
use App\Models;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('ingredient.quantity')->label('Quantity'),
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('ingredient.recipe.name')->label('Recipe'),

                Tables\Columns\BooleanColumn::make('already_own')
                    ->label('Got')
                    ->trueIcon('heroicon-o-check')
                    ->trueColor('success')
                    ->falseIcon('heroicon-o-minus-sm')
                    ->falseColor('secondary')
                    ->action(function (Models\SLItem $record): void {
                        $record->toggleAlreadyOwn();
                    }),


            ])

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
            'edit' => Pages\EditPantry::route('/{record}/edit'),
        ];
    }
    
}
