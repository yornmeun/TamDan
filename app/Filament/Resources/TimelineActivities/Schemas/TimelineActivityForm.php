<?php

namespace App\Filament\Resources\TimelineActivities\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;

class TimelineActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('client_id')
                            ->label(__('timeline_activity.client'))
                            ->relationship('client', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('type')
                            ->label(__('timeline_activity.type'))
                            ->required(),
                    ]),
                Textarea::make('description')
                    ->label(__('timeline_activity.description'))
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }
}
