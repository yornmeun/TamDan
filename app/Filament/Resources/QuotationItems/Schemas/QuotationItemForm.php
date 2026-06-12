<?php

namespace App\Filament\Resources\QuotationItems\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use App\Models\Quotation;

class QuotationItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('quotation_id')
                            ->label(__('quotation_item.quotation'))
                            ->options(Quotation::all()->pluck('quote_number', 'id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('name')
                            ->label(__('quotation_item.name'))
                            ->required(),

                        TextInput::make('qty')
                            ->label(__('quotation_item.qty'))
                            ->numeric()
                            ->required(),

                        TextInput::make('price')
                            ->label(__('quotation_item.price'))
                            ->numeric()
                            ->required(),
                    ]),
                Textarea::make('description')
                    ->label(__('quotation_item.description'))
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }
}
