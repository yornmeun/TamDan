<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('user.name'))
                    ->required(),
                TextInput::make('email')
                    ->label(__('user.email'))
                    ->email()
                    ->required(),
                TextInput::make('phone_number')
                    ->label(__('user.phone'))
                    ->required(),
                DateTimePicker::make('email_verified_at')
                    ->label('Email verified at')
                    ->hidden()
                    ->displayFormat('d/m/Y H:i:s')
                    ->native(false)
                    ->closeOnDateSelection(),
                TextInput::make('password')
                    ->label(__('user.password'))
                    ->password()
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->label(__('user.role'))
                    ->multiple() 
                    ->preload()
                    ->searchable(),
            ]);
    }
}
