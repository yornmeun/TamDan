<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('project_id')
                            ->label(__('task.project'))
                            ->relationship('project', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('assigned_to')
                            ->label(__('task.assigned_to'))
                            ->relationship('assignedTo', 'name')
                            ->searchable()
                            ->preload(),

                        TextInput::make('title')
                            ->label(__('task.title'))
                            ->required(),

                        Select::make('status')
                            ->label(__('task.status'))
                            ->options([
                                'not_started' => __('project.status_not_started'),
                                'in_progress' => __('project.status_in_progress'),
                                'completed' => __('project.status_completed'),
                                'on_hold' => __('project.status_on_hold'),
                                'cancelled' => __('project.status_cancelled'),
                            ])
                            ->required(),

                        DatePicker::make('due_date')
                            ->label(__('task.due_date')),
                    ]),
            ]);
    }
}
