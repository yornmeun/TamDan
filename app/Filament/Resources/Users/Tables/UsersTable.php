<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('user.name')),
                TextColumn::make('email')
                    ->label(__('user.email')),
                TextColumn::make('phone_number')
                    ->label(__('user.phone')),
                TextColumn::make('roles.name')
                    ->label(__('user.role'))
                    ->separator(', ')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label(__('user.created_at'))
                    ->dateTime('j-M-Y H:i:s')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(__('user.updated_at'))
                    ->dateTime('j-M-Y H:i:s')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('name')
                    ->label(__('user.name'))
                    ->preload()
                    ->searchable(),
                SelectFilter::make('email')
                    ->label(__('user.email'))
                    ->preload()
                    ->searchable(),
                SelectFilter::make('phone_number')
                    ->label(__('user.phone'))
                    ->preload()
                    ->searchable(),
                SelectFilter::make('roles')
                    ->label(__('user.role'))
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
                Filter::make('created_at')
                    ->label(__('user.created_at'))
                    ->form([
                        DatePicker::make('start_date_from')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('user.start_date_from')),
                        DatePicker::make('start_date_to')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('user.start_date_to')),
                    ])
                    ->columnSpan(2)
                    ->columns(2)
                    ->query(function (Builder $query, array $data) {
                        if ($data['start_date_from']) {
                            $query->whereDate('start_date', '>=', $data['start_date_from']);
                        }
                        if ($data['start_date_to']) {
                            $query->whereDate('start_date', '<=', $data['start_date_to']);
                        }
                    }),
            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
