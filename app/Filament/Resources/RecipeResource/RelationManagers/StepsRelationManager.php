<?php

namespace App\Filament\Resources\RecipeResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class StepsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'steps';

    protected static ?string $recordTitleAttribute = 'sequence';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sequence')->required(),
                Forms\Components\TextInput::make('instructions')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sequence'),
                Tables\Columns\TextColumn::make('instructions'),
            ])
            ->filters([
                //
            ]);
    }
}
