<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SLRecipeResource\Pages;
use App\Models\SLRecipe;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SLRecipeResource extends Resource
{
    protected static ?string $model = SLRecipe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-database';

    protected static ?string $label = 'Shopping List - Recipe';

    protected static ?string $pluralLabel = 'Shopping List - Recipes';

    protected static ?string $navigationGroup = 'OTHER';

    public static ?int $navigationSort = 990;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('shopping_list_id')
                    ->relationship('shopping_list', 'created_at'),
                Forms\Components\BelongsToSelect::make('recipe_id')
                    ->relationship('recipe', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shopping_list.name'),
                Tables\Columns\TextColumn::make('recipe.name'),
            ])
            ->filters([
                //
            ]);
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
            'index' => Pages\ListSLRecipes::route('/'),
            'create' => Pages\CreateSLRecipe::route('/create'),
            'view' => Pages\ViewSLRecipe::route('/{record}'),
            'edit' => Pages\EditSLRecipe::route('/{record}/edit'),
        ];
    }
}
