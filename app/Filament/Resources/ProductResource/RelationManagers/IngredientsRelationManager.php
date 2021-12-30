<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class IngredientsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'ingredients';

    protected static ?string $recordTitleAttribute = 'recipe.name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('recipe_id')
                    ->relationship('recipe', 'name'),
                Forms\Components\TextInput::make('sequence')->required(),
                Forms\Components\TextInput::make('quantity')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recipe.name'),
                Tables\Columns\TextColumn::make('sequence'),
                Tables\Columns\TextColumn::make('quantity'),
            ])
            ->filters([
                //
            ]);
    }
}
