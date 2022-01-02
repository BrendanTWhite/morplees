<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngredientResource\Pages;
use App\Filament\Resources\IngredientResource\RelationManagers;
use App\Models\Ingredient;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class IngredientResource extends Resource
{
    protected static ?string $model = Ingredient::class;

    protected static ?string $navigationIcon = 'bi-list-ul';

    protected static ?string $navigationGroup = 'Recipes';
    public static ?int $navigationSort = 320;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('recipe_id')
                    ->relationship('recipe', 'name'),
                Forms\Components\TextInput::make('sequence')->required(),
                Forms\Components\TextInput::make('quantity')->required(),
                Forms\Components\BelongsToSelect::make('product_id')
                    ->relationship('product', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recipe.name'),
                Tables\Columns\TextColumn::make('sequence'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('product.name'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SLItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIngredients::route('/'),
            'create' => Pages\CreateIngredient::route('/create'),
            'view' => Pages\ViewIngredient::route('/{record}'),
            'edit' => Pages\EditIngredient::route('/{record}/edit'),
        ];
    }
}
