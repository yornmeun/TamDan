<?php

namespace App\Filament\Resources\Quotations\Schemas;

use App\Models\Client;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use App\Models\Project;

class QuotationForm
{
    protected static function updateTotal(
        Get $get,
        Set $set,
        string $itemsPath = 'quotationItems',
        string $taxPath = 'tax',
        string $discountPath = 'discount',
        string $totalPath = 'total',
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

        $set($totalPath, round($total, 2));
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
                        Select::make('client_id')
                            ->label(__('quotation.client'))
                            ->options(Client::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Select::make('project_id')
                            ->label(__('quotation.project'))
                            ->options(Project::all()->pluck('title', 'id'))
                            ->searchable(),

                        TextInput::make('quote_number')
                            ->default(generateNumber('QUO', auth()->user(), 'quotations'))
                            ->dehydrated()
                            ->disabled()
                            ->label(__('quotation.quote_number'))
                            ->required(),

                        TextInput::make('total')
                            ->label(__('quotation.total'))
                            ->numeric()
                            ->suffix('$')
                            ->disabled()
                            ->dehydrated()
                            ->default(0)
                            ->required(),
                        TextInput::make('tax')
                            ->label(__('quotation.tax'))
                            ->numeric()
                            ->suffix('%')
                            ->default(0)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set): void {
                                self::updateTotal($get, $set);
                            }),
                        TextInput::make('discount')
                            ->label(__('quotation.discount'))
                            ->numeric()
                            ->suffix('$')
                            ->default(0)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set): void {
                                self::updateTotal($get, $set);
                            }),
                        Select::make('status')
                            ->label(__('quotation.status'))
                            ->options([
                                'draft' => __('quotation.status_draft'),
                                'sent' => __('quotation.status_sent'),
                                'accepted' => __('quotation.status_accepted'),
                                'rejected' => __('quotation.status_rejected'),
                            ])
                            ->required(),
                        DatePicker::make('issued_at')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('quotation.issued_at')),

                        DatePicker::make('expired_at')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('quotation.expired_at')),
                    ]),
                Grid::make(1)
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('quotationItems')
                            ->relationship('quotationItems')
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
                                        self::updateTotal($get, $set, '../../quotationItems', '../../tax', '../../discount', '../../total');
                                    })
                                    ->numeric(),
                                TextInput::make('price')
                                    ->default(0)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set): void {
                                        self::updateTotal($get, $set, '../../quotationItems', '../../tax', '../../discount', '../../total');
                                    })
                                    ->numeric(),
                            ])
                            ->columns(4),
                    ]),
            ]);
    }
}
