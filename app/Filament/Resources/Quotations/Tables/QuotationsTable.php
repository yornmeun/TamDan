<?php

namespace App\Filament\Resources\Quotations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class QuotationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quote_number')
                    ->label(__('quotation.quote_number'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.name')
                    ->label(__('quotation.client'))
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label(__('quotation.status'))
                    ->sortable(),
                TextColumn::make('total')
                    ->label(__('quotation.total'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('issued_at')
                    ->label(__('quotation.issued_at'))
                    ->date(),
            ])
            ->filters([
                TrashedFilter::make(),
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
