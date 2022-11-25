<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
use App\Models\Product;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use Filament\Forms\Components;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'bi-journal-text';

    protected static ?string $navigationGroup = '';

    public static ?int $navigationSort = 100;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Components\Card::make()
                ->schema([

                    Components\TextInput::make('name')->required()->autofocus(),

                    Components\Grid::make()
                    ->schema([
                        Components\TextInput::make('prep_time')->numeric()->postfix('mins'),
                        Components\TextInput::make('cook_time')->numeric()->postfix('mins'),
                        Components\TextInput::make('book_reference'),
                    ])->columns(3),

                    Components\TextInput::make('url')->url(),

                    Components\Grid::make()
                    ->columns(2)
                    ->schema([
                        
                        Components\Repeater::make('ingredients')
                        ->relationship()
                        ->orderable('sequence')
                        ->columns([
                            'md' => 10,
                        ])                        
                        ->createItemButtonLabel('Add Ingredient')
                        ->schema([
                            Components\TextInput::make('quantity')->required()->label('')                                    
                            ->columnSpan([
                                'md' => 3,
                            ]),
                            Components\Select::make('product_id')
                            ->label('')
                            ->options(Product::query()->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->columnSpan([
                                'md' => 7,
                            ])
                            ]),
                        ]),                        

                        Components\Repeater::make('steps')
                        ->relationship()
                        ->orderable('sequence')
                        ->createItemButtonLabel('Add Step')
                        ->schema([
                            Components\Textarea::make('instructions')->required()->label('')
                            // ->autosize()
                            ->rows(2)                                    
                            ->columnSpan([
                                'md' => 3,
                            ]),
                        ])
                        ->columns(2),

                    ]),

                ]), // end card

                Components\Card::make()
                ->schema([
                    Components\Placeholder::make('created_at')
                        ->label('Created at')
                        ->content(fn (?Recipe $record): string => $record && $record->created_at ? $record->created_at->diffForHumans() : '-'),
                    Components\Placeholder::make('updated_at')
                        ->label('Last modified at')
                        ->content(fn (?Recipe $record): string => $record && $record->updated_at ? $record->updated_at->diffForHumans() : '-'),
                ])->columns(2)
                ->hidden(fn ($livewire) => $livewire instanceof Pages\CreateRecipe),

            ]); // end form
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('prep_time')->sortable(),
                Tables\Columns\TextColumn::make('cook_time')->sortable(),
                Tables\Columns\TextColumn::make('book_reference')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('url')->searchable()->sortable()
                    ->limit('30')
                    ->url(fn (Recipe $record): string => $record->url ? $record->url : '')
                    ->openUrlInNewTab(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\IngredientsRelationManager::class,
            // RelationManagers\StepsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'view' => Pages\ViewRecipe::route('/{record}'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}
