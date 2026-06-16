<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Actions;
use Filament\Actions\Action;
use Filament\Schemas\Components\Grid;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class InvoiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                ->columnSpanFull()
                ->schema([
                    /// header
                    Grid::make(2)
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextEntry::make('invoice_number')
                                    ->label(__('invoice.invoice_number'))
                                    ->size('lg')
                                    ->weight(FontWeight::Bold),

                                TextEntry::make('status')
                                    ->label(__('invoice.status'))
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'paid'    => 'success',
                                        'sent'    => 'info',
                                        'overdue' => 'danger',
                                        'draft'   => 'gray',
                                        default   => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                            ]),

                        Actions::make([
                            Action::make('download')
                                ->label(__('invoice.download'))
                                ->icon('heroicon-o-arrow-down-tray')
                                ->color('gray')
                                ->outlined(),

                            Action::make('send')
                                ->label(__('invoice.send'))
                                ->icon('heroicon-o-paper-airplane')
                                ->color('gray')
                                ->outlined(),
                        ])->extraAttributes(['class' => 'flex items-end']),
                    ]),

                    Grid::make(3)
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextEntry::make(__('admin.from')),

                                TextEntry::make('owner.name')
                                    ->label(__('user.name'))
                                    ->size(TextSize::Medium)
                                    ->weight(FontWeight::Bold)
                                    ->default(fn () => auth()->user()?->name),
                                TextEntry::make('owner.address')
                                    ->size(TextSize::Medium)
                                    ->label(__('user.address'))
                                    ->default(fn () => auth()->user()?->address),
                                TextEntry::make('owner.email')
                                    ->size(TextSize::Medium)
                                    ->label(__('user.email'))
                                    ->default(fn () => auth()->user()?->email),
                            ]),
                            Grid::make(1)
                            ->schema([
                                TextEntry::make(__('admin.to_bill')),

                                TextEntry::make('project.client.name')
                                    ->label(__('client.name'))
                                    ->size(TextSize::Medium)
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('project.client.company_name')
                                    ->size(TextSize::Medium)
                                    ->label(__('client.company_name')),
                                TextEntry::make('project.client.email')
                                    ->size(TextSize::Medium)
                                    ->label(__('client.email')),
                                TextEntry::make('project.client.phone')
                                    ->size(TextSize::Medium)
                                    ->label(__('client.phone')),
                            ]),
                            Grid::make(1)
                            ->schema([
                                TextEntry::make(__('admin.invoice_detail')),


                                TextEntry::make('project.start_date')
                                    ->label(__('project.start_date'))
                                    ->size(TextSize::Medium)
                                            ->date('d-M-Y'),
                                TextEntry::make('project.due_date')
                                    ->size(TextSize::Medium)
                                    ->label(__('project.due_date'))
                                    ->date('d-M-Y'),
                            ]),

                        
                    ]),
                ])

            ]);
    }
}
