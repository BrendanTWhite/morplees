<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class MenuResource extends Resource
{
    protected static ?string $model = Models\SLRecipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Menu';

    protected static ?string $label = 'Recipe';
    protected static ?string $pluralLabel = 'Recipes';
    protected static ?string $slug = 'menu';

    protected static ?string $navigationGroup = 'Shopping Lists';
    public static ?int $navigationSort = 210;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('recipe_id')
                    ->label('')
                    ->options(Models\Recipe::query()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->searchable()
                    ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recipe.name'),            
            ])
            ->actions([
                Tables\Actions\LinkAction::make('delete')
                    ->label('Remove')
                    ->action(fn (Models\SLRecipe $record) => $record->delete())
                    ->requiresConfirmation()
                        ->modalHeading('Remove Recipe')
                        ->modalSubheading('Remove this Recipe from the Shopping List?')
                        ->modalButton('Yes, Remove it')
                    ->color('danger'),
            ])              
            ->bulkActions([])   
            ->filters([])
            ;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('shopping_list_id', Models\ShoppingList::getActiveSL()?->id);
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
