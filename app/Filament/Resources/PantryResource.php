<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PantryResource\Pages;
use App\Filament\Resources\PantryResource\RelationManagers;
use App\Models\ShoppingList;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class PantryResource extends Resource
{
    protected static ?string $model = ShoppingList::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive';
    protected static ?string $label = 'Pantry';
    protected static ?string $pluralLabel = 'Pantry';
    protected static ?string $slug = 'pantry';

    protected static ?string $navigationGroup = '';
    public static ?int $navigationSort = 140;

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
            'index' => Pages\ListPantrys::route('/'),
            'create' => Pages\CreatePantry::route('/create'),
            'view' => Pages\ViewPantry::route('/{record}'),
            'edit' => Pages\EditPantry::route('/{record}/edit'),
        ];
    }

}
