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
                        TextInput::make('title')
                            ->label(__('task.title'))
                            ->required(),

                        Select::make('project_id')
                            ->label(__('task.project'))
                            ->relationship('project', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        // Select::make('assigned_to')
                        //     ->label(__('task.assigned_to'))
                        //     ->relationship('assignee', 'name')
                        //     ->searchable()
                        //     ->preload(),
                        TextInput::make('assigned_to_name')
                            ->label(__('task.assigned_to')),

                        Select::make('priority')
                            ->label(__('task.priority'))
                            ->searchable()
                            ->preload()
                            ->options([
                                'low' => __('task.priority_low'),
                                'medium' => __('task.priority_medium'),
                                'high' => __('task.priority_high'),
                            ]),

                        Select::make('status')
                            ->label(__('task.status'))
                            ->options([
                                'to_do' => __('task.to_do'),
                                'in_progress' => __('task.in_progress'),
                                'review' => __('task.review'),
                                'done' => __('task.done'),
                                'on_hold' => __('task.on_hole'),
                            ])
                            ->required(),
                            
                        DatePicker::make('due_date')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('task.due_date')),
                    ]),
            ]);
    }
}
