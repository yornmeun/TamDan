<?php

namespace App\Filament\Resources\Tasks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('task.title'))
                    ->sortable(),
                TextColumn::make('project.title')
                    ->label(__('task.project'))
                    ->sortable(),
                // TextColumn::make('assignee.name')
                //     ->label(__('task.assigned_to'))
                //     ->searchable()
                //     ->sortable(),
                TextColumn::make('assigned_to_name')
                    ->label(__('task.assigned_to'))
                    ->sortable(),
                TextColumn::make('priority')
                    ->label(__('task.priority'))
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                            'low' => 'gray',
                            'medium' => 'primary',
                            'high' => 'danger',
                            default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => __('task.priority_low'),
                        'medium' => __('task.priority_medium'),
                        'high' => __('task.priority_high'),
                        default => $state,
                    })
                    ->sortable(),
                
                TextColumn::make('status')
                    ->label(__('task.status'))
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                            'to_do' => 'gray',
                            'in_progress' => 'primary',
                            'review' => 'warning',
                            'done' => 'success',
                            'on_hold' => 'danger',
                            default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'to_do' => __('task.to_do'),
                        'in_progress' => __('task.in_progress'),
                        'review' => __('task.review'),
                        'done' => __('task.done'),
                        'on_hold' => __('task.on_hole'),
                        default => $state,
                    })
                    ->sortable(),
                  
                TextColumn::make('due_date')
                    ->label(__('task.due_date'))
                    ->date('j-M-Y'),
            ])
            ->filters([
                SelectFilter::make('title')
                    ->label(__('task.title'))
                    ->options(fn () => \App\Models\Task::pluck('title', 'title')->toArray())
                    ->preload()
                    ->searchable(),

                SelectFilter::make('project_id')
                    ->label(__('task.project'))
                    ->relationship('project', 'title')
                    ->preload()
                    ->searchable(),

                // SelectFilter::make('assigned_to_name')
                //     ->label(__('task.assigned_to'))
                //     ->relationship('assignee', 'name')
                //     ->preload()
                //     ->searchable(),
                SelectFilter::make('assigned_to_name')
                    ->label(__('task.assigned_to'))
                    ->options(fn () => \App\Models\Task::query()
                    ->whereNotNull('assigned_to_name')
                    ->pluck('assigned_to_name', 'assigned_to_name')
                    ->toArray())
                    ->preload()
                    ->searchable(),

                SelectFilter::make('priority')
                    ->label(__('task.priority'))
                    ->options([
                        'low' => __('task.priority_low'),
                        'medium' => __('task.priority_medium'),
                        'high' => __('task.priority_high'),
                    ])
                    ->preload(),

                SelectFilter::make('status')
                    ->label(__('task.status'))
                    ->options([
                        'to_do' => __('task.to_do'),
                        'in_progress' => __('task.in_progress'),
                        'review' => __('task.review'),
                        'done' => __('task.done'),
                        'on_hold' => __('task.on_hold'),
                    ])
                    ->preload(),

                Filter::make('due_date')
                    ->label(__('task.due_date'))
                    ->form([
                        DatePicker::make('due_date_from')
                            ->label(__('task.due_date_from'))
                            ->displayFormat('d/MM/Y')
                            ->native(false)
                            ->closeOnDateSelection(),

                        DatePicker::make('due_date_to')
                            ->label(__('task.due_date_to'))
                            ->displayFormat('d/MM/Y')
                            ->native(false)
                            ->closeOnDateSelection(),
                    ])
                    ->columns(2)
                    ->columnSpan(2)
                    ->query(function (Builder $query, array $data) {
                        $query
                            ->when(
                                $data['due_date_from'],
                                fn (Builder $query, $date) => $query->whereDate('due_date', '>=', $date)
                            )
                            ->when(
                                $data['due_date_to'],
                                fn (Builder $query, $date) => $query->whereDate('due_date', '<=', $date)
                            );
                    }),
            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
