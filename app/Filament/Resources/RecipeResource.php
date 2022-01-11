<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'bi-journal-text';

    protected static ?string $navigationGroup = 'Recipes';
    public static ?int $navigationSort = 310;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\BelongsToSelect::make('family_id')
                    ->relationship('family', 'name'),
                Forms\Components\TextInput::make('prep_time'),
                Forms\Components\TextInput::make('cook_time'),
                Forms\Components\TextInput::make('book_reference'),
                Forms\Components\TextInput::make('url'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('family.name')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('prep_time')->sortable(),
                Tables\Columns\TextColumn::make('cook_time')->sortable(),
                Tables\Columns\TextColumn::make('book_reference')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('url')->searchable()->sortable()
                    ->url(fn (Recipe $record): string => $record->url)
                    ->openUrlInNewTab(),
            ])
            ->filters([
                SelectFilter::make('family')->relationship('family', 'name'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\IngredientsRelationManager::class,
            RelationManagers\StepsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'view' => Pages\ViewRecipe::route('/{record}'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereBelongsTo(auth()->user()->family);
    }

}
