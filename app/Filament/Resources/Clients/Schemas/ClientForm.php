<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Textarea;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('client.name'))
                            ->required(),

                        TextInput::make('company_name')
                            ->label(__('client.company_name')),

                        TextInput::make('phone')
                            ->label(__('client.phone'))
                            ->required(),
                    ]),
                    Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('email')
                            ->label(__('client.email'))
                            ->required(),

                        TextInput::make('address')
                            ->label(__('client.address'))
                            ->required(),
                    ]),
                    Grid::make(1)
                    ->columnSpanFull()
                    ->schema([
                        Textarea::make('notes')
                            ->label(__('client.notes'))
                            ->rows(10)
                            ->cols(20)

                    ]),
            ]);
    }
}
