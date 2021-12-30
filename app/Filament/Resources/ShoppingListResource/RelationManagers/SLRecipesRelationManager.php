<?php

namespace App\Filament\Resources\ShoppingListResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class SLRecipesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 's_l_recipes';

    protected static ?string $label = 'Shopping List - Recipe';
    protected static ?string $pluralLabel = 'Shopping List - Recipes';

    protected static ?string $recordTitleAttribute = 'recipe_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('recipe_id')
                    ->relationship('recipe', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recipe.name'),
            ])
            ->filters([
                //
            ]);
    }
}
