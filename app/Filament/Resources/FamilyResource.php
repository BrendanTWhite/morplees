<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyResource\Pages;
use App\Filament\Resources\FamilyResource\RelationManagers;
use App\Models\Family;
use Closure;
use Filament\Forms\Components;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'OTHER';

    public static ?int $navigationSort = 910;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Components\TextInput::make('name')->required(),
                Components\Toggle::make('ical_active')
                    ->label('Activate Calendar')->reactive(),
                Components\TextInput::make('ical_url')
                ->label('Calendar URL')
                ->disabled()
                ->hidden(fn (Closure $get) => ! $get('ical_active'))
                ->suffixAction(fn ($get) => Action::make('visit')
                    ->icon('heroicon-s-external-link')
                    ->url(
                        $get('ical_url'),
                        shouldOpenInNewTab: true,
                    ),
                ),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('name')->searchable()->sortable(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UsersRelationManager::class,
            RelationManagers\ShopsRelationManager::class,
            RelationManagers\RecipesRelationManager::class,
            RelationManagers\ShoppingListsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'view' => Pages\ViewFamily::route('/{record}'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
