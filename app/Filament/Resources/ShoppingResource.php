<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShoppingResource\Pages;
use App\Filament\Resources\ShoppingResource\RelationManagers;
use App\Models\ShoppingList;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class ShoppingResource extends Resource
{
    protected static ?string $model = ShoppingList::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $label = 'Shopping';
    protected static ?string $pluralLabel = 'Shopping';
    protected static ?string $slug = 'shopping';

    protected static ?string $navigationGroup = 'OTHER';
    public static ?int $navigationSort = 999;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('created_at')
                    ->disabled(),
                Forms\Components\TextInput::make('override_name')
                    ->placeholder('If not specified, the create date will be used')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Shopping List')->searchable(['override_name']),
                Tables\Columns\TextColumn::make('slitems_count')->counts('slitems')->label('Total Items'),
                Tables\Columns\BooleanColumn::make('active')
                ->trueIcon('heroicon-o-check')
                ->trueColor('success')
                ->falseIcon('heroicon-o-minus-sm')
                ->falseColor('secondary')
                ->action(function (ShoppingList $record): void {
                    $record->toggleActive();
                }),

            ])
            ->actions([]) 
            ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SLRecipesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShoppings::route('/'),
            'create' => Pages\CreateShopping::route('/create'),
            'view' => Pages\ViewShopping::route('/{record}'),
            'edit' => Pages\EditShopping::route('/{record}/edit'),
        ];
    }

}
