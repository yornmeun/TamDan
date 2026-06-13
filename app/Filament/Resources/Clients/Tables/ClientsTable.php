<?php

namespace App\Filament\Resources\Clients\Tables;

use App\Models\Client;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\SelectFilter;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('client.name'))
                    ->sortable(),
                TextColumn::make('company_name')
                    ->label(__('client.company_name'))
                    ->sortable(),
                TextColumn::make('phone')
                    ->label(__('client.phone'))
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('client.email'))
                    ->sortable(),
                TextColumn::make('address')
                    ->label(__('client.address'))
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('name')
                    ->label(__('client.name'))
                    ->options(Client::all()->pluck('name', 'name')->toArray())
                    ->preload()
                    ->searchable(),
                SelectFilter::make('company_name')
                    ->label(__('client.company_name'))
                    ->options(Client::all()->pluck('company_name', 'company_name')->toArray())
                    ->preload()
                    ->searchable(),
                    SelectFilter::make('phone')
                    ->label(__('client.phone'))
                    ->options(Client::all()->pluck('phone', 'phone')->toArray())
                    ->preload()
                    ->searchable(),
                    SelectFilter::make('email')
                    ->label(__('client.email'))
                    ->options(Client::all()->pluck('email', 'email')->toArray())
                    ->preload()
                    ->searchable(),
            ],layout: FiltersLayout::AboveContent)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
