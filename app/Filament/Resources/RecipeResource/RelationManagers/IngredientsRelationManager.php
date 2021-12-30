<?php

namespace App\Filament\Resources\RecipeResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class IngredientsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'ingredients';

    protected static ?string $recordTitleAttribute = 'quantity';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Tables\Columns\TextColumn::make('sequence'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('product.name'),
            ])
            ->filters([
                //
            ]);
    }
}
