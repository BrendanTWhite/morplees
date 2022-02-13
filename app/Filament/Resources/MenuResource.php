<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\ShoppingList;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class MenuResource extends Resource
{
    protected static ?string $model = ShoppingList::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $label = 'Menu';
    protected static ?string $pluralLabel = 'Menu';
    protected static ?string $navigationLabel = 'Menu';
    protected static ?string $createButtonLabel = 'Shopping List';
    protected static ?string $slug = 'menu';

    protected static ?string $navigationGroup = 'Shopping Lists';
    public static ?int $navigationSort = 210;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('override_name')
                    ->label('Shopping List Name (optional)')
                    ->placeholder('If not specified, the create date will be used')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Shopping List')->sortable(['created_at'])->searchable(['override_name']),
                Tables\Columns\TextColumn::make('slrecipes_count')->counts('slrecipes')->label('Recipes'),
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
            ->defaultSort('name', 'desc')
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->default()
                    ->query(
                        fn (Builder $query): Builder => $query->whereActive(TRUE) ),
                    ]) 
            ->actions([]) 
            ->bulkActions([]) 
            ;
    }

    public static function getCreateButtonLabel(): string
    {
        return static::$createButtonLabel ?? static::$label;
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'view' => Pages\ViewMenu::route('/{record}'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }

}
