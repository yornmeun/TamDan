<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('project_id')
                            ->label(__('invoice.project'))
                            ->relationship('project', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('invoice_number')
                            ->default(function(){
                                $invoiceNumber = generateNumber('INV', auth()->user(), 'invoices');
                                return $invoiceNumber;
                            })
                            ->disabled()
                            ->label(__('invoice.invoice_number'))
                            ->required(),

                        TextInput::make('total')
                            ->label(__('invoice.total'))
                            ->numeric()
                            ->required(),

                        TextInput::make('paid_amount')
                            ->label(__('invoice.paid_amount'))
                            ->numeric()
                            ->required(),

                        TextInput::make('due_amount')
                            ->label(__('invoice.due_amount'))
                            ->numeric()
                            ->required(),
                        Select::make('status')
                            ->label(__('invoice.status'))
                            ->options([
                                'draft' => __('invoice.status_draft'),
                                'sent' => __('invoice.status_sent'),
                                'paid' => __('invoice.status_paid'),
                                'overdue' => __('invoice.status_overdue'),
                            ])
                            ->required(),
                    ]),
            ]);
    }
}
