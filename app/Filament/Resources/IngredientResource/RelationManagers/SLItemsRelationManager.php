<?php

namespace App\Filament\Resources\IngredientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\MorphManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class SLItemsRelationManager extends MorphManyRelationManager
{
    protected static string $relationship = 's_l_items';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $label = 'Shopping List Item';

    protected static ?string $pluralLabel = 'Shopping List Items';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('shopping_list_id')
                    ->relationship('shopping_list', 'created_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shopping_list.name'),
                Tables\Columns\TextColumn::make('product.name'),
            ])
            ->filters([
                //
            ]);
    }
}
