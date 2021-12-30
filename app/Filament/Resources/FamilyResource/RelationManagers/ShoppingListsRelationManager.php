<?php

namespace App\Filament\Resources\FamilyResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ShoppingListsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'shopping_lists';

    protected static ?string $label = 'Shopping List';
    protected static ?string $pluralLabel = 'Shopping Lists';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('override_name')
                    ->placeholder('If not specified, the create date will be used'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ]);
    }
}
