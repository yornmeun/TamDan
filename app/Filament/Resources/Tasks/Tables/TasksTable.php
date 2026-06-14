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

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('task.title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project.title')
                    ->label(__('task.project'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('assignedTo.name')
                    ->label(__('task.assigned_to'))
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label(__('task.status'))
                    ->sortable(),
                TextColumn::make('due_date')
                    ->label(__('task.due_date'))
                    ->date(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'not_started' => __('project.status_not_started'),
                        'in_progress' => __('project.status_in_progress'),
                        'completed' => __('project.status_completed'),
                        'on_hold' => __('project.status_on_hold'),
                        'cancelled' => __('project.status_cancelled'),
                    ]),
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
