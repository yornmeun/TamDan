<?php

namespace App\Filament\Resources\Invoices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Actions\DeleteAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Invoice;
use App\Models\Project;

class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                    ->label(__('invoice.invoice_number'))
                    ->sortable(),
                TextColumn::make('project.title')
                    ->label(__('invoice.project'))
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
                DeleteAction::make(),
            ])
            ->filters([
                SelectFilter::make('invoice_number')
                    ->label(__('invoice.invoice_number'))
                    ->searchable()
                    ->preload()
                    ->options(fn () => Invoice::pluck('invoice_number', 'invoice_number')->toArray()),
                SelectFilter::make('project_id')
                    ->label(__('invoice.project'))
                    ->searchable()
                    ->preload()
                    ->options(fn () => Project::pluck('title', 'id')->toArray()),
                SelectFilter::make('status')
                    ->label(__('invoice.status'))
                    ->options([
                        'draft' => __('invoice.status_draft'),
                        'sent' => __('invoice.status_sent'),
                        'paid' => __('invoice.status_paid'),
                        'overdue' => __('invoice.status_overdue'),
                    ]),
            ],layout: FiltersLayout::AboveContent)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
