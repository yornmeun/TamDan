<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('project.title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.name')
                    ->label(__('project.client'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quotation.quote_number')
                    ->label(__('project.quotation'))
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label(__('project.status'))
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label(__('project.start_date'))
                    ->date(),
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
