<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Psy\Readline\Hoa\Console;

class InvoiceForm
{
    protected static function updateTotal(
        Get $get,
        Set $set,
        string $itemsPath = 'invoiceItems',
        string $taxPath = 'tax',
        string $discountPath = 'discount',
        string $totalPath = 'total',
        string $paidAmountPath = 'paid_amount',
        string $dueAmountPath = 'due_amount',
    ): void {
        $items = $get($itemsPath) ?? [];
        $subtotal = 0;

        foreach ($items as $item) {
            $subtotal += (float) ($item['qty'] ?? 0) * (float) ($item['price'] ?? 0);
        }

        $taxPercent = (float) ($get($taxPath) ?? 0);
        $discount = (float) ($get($discountPath) ?? 0);
        $amountAfterDiscount = max(0, $subtotal - $discount);
        $taxAmount = $amountAfterDiscount * ($taxPercent / 100);
        $total = $amountAfterDiscount - $taxAmount;

        $total = round($total, 2);
        $paidAmount = (float) ($get($paidAmountPath) ?? 0);

        $set($totalPath, $total);
        $set($dueAmountPath, round(max(0, $total - $paidAmount), 2));
    }

    protected static function updateDueAmount(
        Get $get,
        Set $set,
        string $totalPath = 'total',
        string $paidAmountPath = 'paid_amount',
        string $dueAmountPath = 'due_amount',
    ): void {
        $total = (float) ($get($totalPath) ?? 0);
        $paidAmount = (float) ($get($paidAmountPath) ?? 0);

        $set($dueAmountPath, round(max(0, $total - $paidAmount), 2));
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->columnSpanFull()
                    ->schema([
                        Hidden::make('user_id')
                            ->default(auth()->user()->id),
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
                            ->dehydrated()
                            ->label(__('invoice.invoice_number'))
                            ->required(),

                        TextInput::make('total')
                            ->label(__('invoice.total'))
                            ->disabled()
                            ->dehydrated()
                            ->numeric()
                            ->required(),
                        TextInput::make('tax')
                            ->label(__('invoice.tax'))
                            ->numeric()
                            ->suffix('%')
                            ->default(0)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set): void {
                                self::updateTotal($get, $set);
                            }),
                        TextInput::make('discount')
                            ->label(__('invoice.discount'))
                            ->numeric()
                            ->suffix('$')
                            ->default(0)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set): void {
                                self::updateTotal($get, $set);
                            }),

                        TextInput::make('paid_amount')
                            ->label(__('invoice.paid_amount'))
                            ->numeric()
                            ->required()
                            ->live()
                            ->afterStateUpdated( function (Get $get, Set $set): void {
                                self::updateDueAmount($get, $set);
                            }),

                        TextInput::make('due_amount')
                            ->label(__('invoice.due_amount'))
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
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
                    Grid::make(1)
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('invoiceItems')
                            ->relationship('invoiceItems')
                            ->label(__('quotation.quotation_items'))
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set): void {
                                self::updateTotal($get, $set);
                            })
                            ->table([
                                TableColumn::make(__('quotation.name')),
                                TableColumn::make(__('quotation.description')),
                                TableColumn::make(__('quotation.qty')),
                                TableColumn::make(__('quotation.price')),
                            ])
                            ->schema([
                                TextInput::make('name'),
                                TextInput::make('description')
                                ->required(false),
                                TextInput::make('qty')
                                    ->default(1)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set): void {
                                        self::updateTotal($get, $set, '../../invoiceItems', '../../tax', '../../discount', '../../total', '../../paid_amount', '../../due_amount');
                                    })
                                    ->numeric(),
                                TextInput::make('price')
                                    ->default(0)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set): void {
                                        self::updateTotal($get, $set, '../../invoiceItems', '../../tax', '../../discount', '../../total', '../../paid_amount', '../../due_amount');
                                    })
                                    ->numeric(),
                            ])
                            ->columns(4),
                    ]),
            ]);
    }
}
