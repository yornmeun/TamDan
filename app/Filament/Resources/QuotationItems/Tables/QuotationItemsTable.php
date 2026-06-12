<?php

namespace App\Filament\Resources\QuotationItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class QuotationItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('quotation_item.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quotation.quote_number')
                    ->label(__('quotation_item.quotation'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('qty')
                    ->label(__('quotation_item.qty'))
                    ->sortable(),
                TextColumn::make('price')
                    ->label(__('quotation_item.price'))
                    ->sortable(),
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
