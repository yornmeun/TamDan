<?php

namespace App\Filament\Resources\Invoices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                    ->label(__('invoice.invoice_number'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project.title')
                    ->label(__('invoice.project'))
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label(__('invoice.status'))
                    ->sortable(),
                TextColumn::make('total')
                    ->label(__('invoice.total'))
                    ->sortable(),
                TextColumn::make('due_amount')
                    ->label(__('invoice.due_amount'))
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
