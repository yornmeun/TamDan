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
                            ->preload(),

                        TextInput::make('title')
                            ->label(__('project.title'))
                            ->required(),

                        Select::make('status')
                            ->label(__('project.status'))
                            ->options([
                                'not_started' => __('project.status_not_started'),
                                'in_progress' => __('project.status_in_progress'),
                                'completed' => __('project.status_completed'),
                                'on_hold' => __('project.status_on_hold'),
                                'cancelled' => __('project.status_cancelled'),
                            ])
                            ->required(),

                        DatePicker::make('start_date')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('project.start_date')),

                        DatePicker::make('due_date')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('project.due_date')),
                    ]),
                Textarea::make('description')
                    ->label(__('project.description'))
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }
}
