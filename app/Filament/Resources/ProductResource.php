<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'lineawesome-apple-alt-solid';

    protected static ?string $navigationGroup = '';

    public static ?int $navigationSort = 110;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\BelongsToSelect::make('shop_id')->required()
                    ->relationship('shop', 'name'),
                Forms\Components\Checkbox::make('default_in_list'),
                Forms\Components\Checkbox::make('needed_soon'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\BooleanColumn::make('needed_soon')->sortable()
                ->label('Need Soon')
                ->trueIcon('heroicon-o-check')
                ->trueColor('success')
                ->falseIcon('heroicon-o-minus-sm')
                ->falseColor('secondary')
                ->action(function (Product $record): void {
                    $record->toggleNeededSoon();
                }),

                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('shop.name')->searchable()->sortable(),

                Tables\Columns\BooleanColumn::make('default_in_list')->sortable()
                ->label('Usually Need')
                ->trueIcon('heroicon-o-check')
                ->trueColor('success')
                ->falseIcon('heroicon-o-minus-sm')
                ->falseColor('secondary')
                ->action(function (Product $record): void {
                    $record->toggleDefaultInList();
                }),

            ])
            ->actions([
                //
            ])
            ->filters([
                SelectFilter::make('shop')->relationship('shop', 'name'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\IngredientsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
