<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class IngredientsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'ingredients';

    protected static ?string $recordTitleAttribute = 'recipe.name';

    protected static ?string $title = 'Used in...';

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
            ->headerActions([])
            ->bulkActions([])
            ->columns([
                Tables\Columns\TextColumn::make('recipe.name'),
                //Tables\Columns\TextColumn::make('sequence'),
                Tables\Columns\TextColumn::make('quantity'),
            ])
            ->actions([
                //
            ])
            ->filters([
                //
            ]);
    }

    protected function getTableRecordUrlUsing(): Closure
    {
        return fn (Model $record): string => route('filament.resources.recipes.view', ['record' => $record->recipe_id]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            //'create' => Pages\CreateProduct::route('/create'),
            //'view' => Pages\ViewProduct::route('/{record}'),
            //'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
