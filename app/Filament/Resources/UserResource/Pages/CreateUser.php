<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\Pages\CreateFilamentRecord;

class CreateUser extends CreateFilamentRecord
{
    protected static string $resource = UserResource::class;
}
