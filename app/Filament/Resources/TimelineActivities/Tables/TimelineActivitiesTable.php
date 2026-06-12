<?php

namespace App\Filament\Resources\TimelineActivities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TimelineActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label(__('timeline_activity.type'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.name')
                    ->label(__('timeline_activity.client'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label(__('timeline_activity.description'))
                    ->limit(50),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
