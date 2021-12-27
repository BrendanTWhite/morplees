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
            'index' => Pages\ListSLItems::route('/'),
            'create' => Pages\CreateSLItem::route('/create'),
            'edit' => Pages\EditSLItem::route('/{record}/edit'),
        ];
    }
}
