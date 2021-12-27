<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SLRecipeResource\Pages;
use App\Filament\Resources\SLRecipeResource\RelationManagers;
use App\Models\SLRecipe;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SLRecipeResource extends Resource
{
    protected static ?string $model = SLRecipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'edit' => Pages\EditSLRecipe::route('/{record}/edit'),
        ];
    }
}
