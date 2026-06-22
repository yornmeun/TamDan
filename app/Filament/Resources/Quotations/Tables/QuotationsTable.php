<?php

namespace App\Filament\Resources\Quotations\Tables;

use App\Models\Quotation;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class QuotationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quote_number')
                    ->label(__('quotation.quote_number'))
                    ->sortable(),
                TextColumn::make('client.name')
                    ->label(__('quotation.client'))
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label(__('quotation.status'))
                    ->color(fn ($state) => match ($state) {
                          'draft' => 'gray',
                            'sent' => 'info',
                            'accepted' => 'success',
                            'rejected' => 'danger',
                            default => 'gray',
                    })
                     ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => __('quotation.status_draft'),
                        'sent' => __('quotation.status_sent'),
                        'accepted' => __('quotation.status_accepted'),
                        'rejected' => __('quotation.status_rejected'),
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('total')
                    ->label(__('quotation.total'))
                    ->formatStateUsing(fn ($state) => '$' . number_format($state, 2))
                    ->sortable(),
                TextColumn::make('issued_at')
                    ->label(__('quotation.issued_at'))
                    ->date('j-M-Y'),
                TextColumn::make('expired_at')
                    ->label(__('quotation.expired_at'))
                    ->date('j-M-Y'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                Action::make('downloadPdf')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Quotation $record): string => route('quotations.download-pdf', $record)),
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->filters([
                SelectFilter::make('quot_number')
                    ->label(__('quotation.quote_number'))
                    ->searchable()
                    ->preload()
                    ->options(function () {
                        return \App\Models\Quotation::pluck('quote_number', 'id');
                    }),
                SelectFilter::make('client_id')
                    ->label(__('quotation.client'))
                    ->searchable()
                    ->preload()
                    ->options(function () {
                        return \App\Models\Client::pluck('name', 'id');
                    }),
                SelectFilter::make('status')
                    ->label(__('quotation.status'))
                    ->options([
                        'draft' => __('quotation.status_draft'),
                        'sent' => __('quotation.status_sent'),
                        'approved' => __('quotation.status_approved'),
                        'rejected' => __('quotation.status_rejected'),
                    ]),
                Filter::make('issued_at')
                    ->label(__('quotation.issued_at'))
                    ->form([
                        DatePicker::make('start_date_from')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('quotation.start_date_from')),
                        DatePicker::make('start_date_to')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('quotation.start_date_to')),
                    ])
                    ->columnSpan(2)
                    ->columns(2)
                    ->query(function (Builder $query, array $data) {
                        if ($data['start_date_from']) {
                            $query->whereDate('issued_at', '>=', $data['start_date_from']);
                        }
                        if ($data['start_date_to']) {
                            $query->whereDate('issued_at', '<=', $data['start_date_to']);
                        }
                    }),
            ], layout: FiltersLayout::AboveContent)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
