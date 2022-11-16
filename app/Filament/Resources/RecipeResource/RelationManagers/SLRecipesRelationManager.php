<?php

namespace App\Filament\Resources\RecipeResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;

class SLRecipesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 's_l_recipes';

    protected static ?string $recordTitleAttribute = 'recipe_id';

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
}
