<?php

namespace App\Filament\Resources\Quotations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use App\Models\Client;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('client_id')
                            ->label(__('quotation.client'))
                            ->options(Client::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('quote_number')
                            ->label(__('quotation.quote_number'))
                            ->required(),

                        TextInput::make('total')
                            ->label(__('quotation.total'))
                            ->numeric()
                            ->required(),

                        TextInput::make('status')
                            ->label(__('quotation.status'))
                            ->required(),

                        DatePicker::make('issued_at')
                            ->label(__('quotation.issued_at')),
                    ]),
            ]);
    }
}
