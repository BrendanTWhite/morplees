<?php

namespace App\Filament\Resources\FamilyResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class UsersRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\Textarea::make('note')->disabled()->label('')->columnSpan(2)->autosize()
                ->hidden(fn (string $context) => $context != 'create')
                ->default('Note - Morplees will not email this person their password.
You will need to contact them and ask them to reset their password on the password reset page.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
            ]);
    }
}
