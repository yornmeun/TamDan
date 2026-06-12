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

                        TextInput::make('status')
                            ->label(__('invoice.status'))
                            ->required(),
                    ]),
            ]);
    }
}
