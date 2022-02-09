<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SLItemResource\Pages;
use App\Filament\Resources\SLItemResource\RelationManagers;
use App\Models\SLItem;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SLItemResource extends Resource
{
    protected static ?string $model = SLItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-database';
    protected static ?string $label = 'Shopping List - Item';
    protected static ?string $pluralLabel = 'Shopping List - Items';

    protected static ?string $navigationGroup = 'OTHER';
    public static ?int $navigationSort = 999;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('shopping_list_id')
                    ->relationship('shopping_list', 'created_at')
                    ->required(),

                Forms\Components\Checkbox::make('already_own'),
                Forms\Components\Checkbox::make('in_basket'),


                Forms\Components\Select::make('itemable_type')
                    ->options([
                        'App\Models\Product' => 'Product',
                        'App\Models\Ingredient' => 'Recipe Ingredient',
                    ])->required()->disablePlaceholderSelection(),

                // Forms\Components\TextInput::make('itemable_type')->required(),
                Forms\Components\TextInput::make('itemable_id')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shopping_list.name'),
                Tables\Columns\BooleanColumn::make('already_own'),
                Tables\Columns\BooleanColumn::make('in_basket'),
//                Tables\Columns\TextColumn::make('itemable_type'),
                Tables\Columns\IconColumn::make('itemable_type')
                    ->options([
                        'heroicon-o-x-circle',
                        'bi-list-ul' => 'App\Models\Ingredient',
                        'lineawesome-apple-alt-solid' => 'App\Models\Product',
                    ]),
                Tables\Columns\TextColumn::make('itemable_id'),
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
            'index' => Pages\ListSLItems::route('/'),
            'create' => Pages\CreateSLItem::route('/create'),
            'view' => Pages\ViewSLItem::route('/{record}'),
            'edit' => Pages\EditSLItem::route('/{record}/edit'),
        ];
    }
}
