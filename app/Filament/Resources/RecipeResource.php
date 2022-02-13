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
use Filament\Tables\Filters\SelectFilter;

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

                Forms\Components\Card::make()
                ->schema([

                    Forms\Components\TextInput::make('name')->required()->autofocus(),

                    Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('prep_time')->numeric()->postfix('mins'),
                        Forms\Components\TextInput::make('cook_time')->numeric()->postfix('mins'),
                        Forms\Components\TextInput::make('book_reference'),
                    ])->columns(3),
                    
                    Forms\Components\TextInput::make('url')->url(),

                    Forms\Components\Grid::make()
                    ->schema([

                        Forms\Components\HasManyRepeater::make('ingredients')
                            ->relationship('ingredients')
                            ->schema([
                                Forms\Components\Hidden::make('sequence')->default(999),

                                // Forms\Components\TextInput::make('sequence')->numeric()->label('')->prefix('#')
                                //     ->columnSpan([
                                //         'md' => 3,
                                //     ]),

                                Forms\Components\TextInput::make('quantity')->label('')
                                    ->columnSpan([
                                        'md' => 3,
                                    ]),

                                Forms\Components\Select::make('product_id')
                                    //->columns(3)
                                    ->label('')
                                    ->options(Product::query()->pluck('name', 'id'))
                                    ->required()
                                    ->columnSpan([
                                        'md' => 7,
                                    ])
                                    ->reactive(),

                            ])
                            ->columns([
                                'md' => 10,
                            ])                            
                            ->createItemButtonLabel('Add Ingredient'),

                        Forms\Components\HasManyRepeater::make('steps')
                            ->relationship('steps')
                            ->schema([
                                Forms\Components\Hidden::make('sequence')->default(999),
                                // Forms\Components\TextInput::make('sequence')->numeric()->label('')->prefix('#')                                    
                                // ->columnSpan([
                                //     'md' => 3,
                                // ]),

                                Forms\Components\TextInput::make('instructions')->label('')
                                ->columnSpan([
                                    'md' => 10,
                                ]),
                            ])
                            ->columns([
                                'md' => 10,
                            ])                            
                            ->createItemButtonLabel('Add Step'),

                    ])
                    ->columns(2),
                        
                ]), // end card

                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\Placeholder::make('created_at')
                        ->label('Created at')
                        ->content(fn (?Recipe $record): string => $record && $record->created_at ? $record->created_at->diffForHumans() : '-'),
                    Forms\Components\Placeholder::make('updated_at')
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
