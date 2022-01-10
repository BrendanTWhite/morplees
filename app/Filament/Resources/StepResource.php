<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StepResource\Pages;
use App\Filament\Resources\StepResource\RelationManagers;
use App\Models\Step;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class StepResource extends Resource
{
    protected static ?string $model = Step::class;

    protected static ?string $navigationIcon = 'bi-list-ol';

    protected static ?string $navigationGroup = 'Recipes';
    public static ?int $navigationSort = 330;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('recipe_id')
                    ->relationship('recipe', 'name'),
                Forms\Components\TextInput::make('sequence')->required(),
                Forms\Components\TextInput::make('instructions')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recipe.name')->sortable(),
                Tables\Columns\TextColumn::make('sequence')->sortable(),
                Tables\Columns\TextColumn::make('instructions')->sortable(),
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
            'index' => Pages\ListSteps::route('/'),
            'create' => Pages\CreateStep::route('/create'),
            'view' => Pages\ViewStep::route('/{record}'),
            'edit' => Pages\EditStep::route('/{record}/edit'),
        ];
    }
}
