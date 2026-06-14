<?php

namespace App\Filament\Resources\Quotations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use App\Models\Client;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Repeater\TableColumn;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Hidden::make('user_id')
                            ->default(auth()->user()->id),
                        Select::make('client_id')
                            ->label(__('quotation.client'))
                            ->options(Client::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

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
                            ->required(),
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
                                ->table([
                                        TableColumn::make(__('quotation.name')),
                                        TableColumn::make(__('quotation.description')),
                                        TableColumn::make(__('quotation.qty')),
                                        TableColumn::make(__('quotation.price')),
                                ])
                                ->schema([
                                    TextInput::make('name'),
                                    TextInput::make('description'),
                                    TextInput::make('qty')
                                    ->numeric(),
                                    TextInput::make('price')
                                    ->numeric(),
                                ])
                                ->columns(4)
                    ]),
            ]);
    }
}
