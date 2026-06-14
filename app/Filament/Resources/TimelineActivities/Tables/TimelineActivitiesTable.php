<?php

namespace App\Filament\Resources\TimelineActivities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use App\Models\Client;
use App\Models\TimelineActivity;

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
                DeleteAction::make(),
            ])
            ->filters([
                SelectFilter::make('client_id')
                    ->label(__('timeline_activity.client'))
                    ->searchable()
                    ->preload()
                    ->options(fn () => Client::pluck('name','id')->toArray()),
                SelectFilter::make('type')
                    ->label(__('timeline_activity.type'))
                    ->options(fn () => TimelineActivity::pluck('type','type')->toArray()),
            ], layout: FiltersLayout::AboveContent)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
