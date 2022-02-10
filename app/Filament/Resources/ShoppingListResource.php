<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShoppingListResource\Pages;
use App\Filament\Resources\ShoppingListResource\RelationManagers;
use App\Models\ShoppingList;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class ShoppingListResource extends Resource
{
    protected static ?string $model = ShoppingList::class;

    protected static ?string $navigationIcon = 'bi-file-text';

    protected static ?string $navigationGroup = 'OTHER';
    public static ?int $navigationSort = 999;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('created_at')
                    ->disabled(),
                Forms\Components\TextInput::make('override_name')
                    ->placeholder('If not specified, the create date will be used')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Shopping List')->searchable(['override_name']),
                Tables\Columns\TextColumn::make('slrecipes_count')->counts('slrecipes')->label('Recipes'),
                Tables\Columns\TextColumn::make('slitems_count')->counts('slitems')->label('Total Items'),
                Tables\Columns\BooleanColumn::make('active'),
            ])
            ->actions([]) 
            ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SLRecipesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShoppingLists::route('/'),
            'create' => Pages\CreateShoppingList::route('/create'),
            'view' => Pages\ViewShoppingList::route('/{record}'),
            'edit' => Pages\EditShoppingList::route('/{record}/edit'),
        ];
    }

}
