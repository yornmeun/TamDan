<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('client_id')
                            ->label(__('project.client'))
                            ->relationship('client', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('quotation_id')
                            ->label(__('project.quotation'))
                            ->relationship('quotation', 'quote_number')
                            ->searchable()
                            ->preload(),

                        TextInput::make('title')
                            ->label(__('project.title'))
                            ->required(),

                        TextInput::make('status')
                            ->label(__('project.status'))
                            ->required(),

                        DatePicker::make('start_date')
                            ->label(__('project.start_date')),

                        DatePicker::make('due_date')
                            ->label(__('project.due_date')),
                    ]),
                Textarea::make('description')
                    ->label(__('project.description'))
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }
}
