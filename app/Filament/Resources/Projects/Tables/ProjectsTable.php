<?php

namespace App\Filament\Resources\Projects\Tables;

use App\Models\Project;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->extraAttributes(['class' => 'component-card-table'])
            ->content(view('projects.list-project'))
            ->modifyQueryUsing(fn (Builder $query): Builder => $query
                ->with('client')
                ->withCount('tasks'))
            ->paginationPageOptions([5, 10, 20, 50, 100, 'all'])
            ->defaultPaginationPageOption(10)
            // ->columns([
                // TextColumn::make('title')
                //     ->label(__('project.title'))
                //     ->sortable(),
                // TextColumn::make('client.name')
                //     ->label(__('project.client'))
                //     ->sortable(),
                // TextColumn::make('quotation.quote_number')
                //     ->label(__('project.quotation'))
                //     ->sortable(),
                // TextColumn::make('status')
                //     ->label(__('project.status'))
                //     ->badge()
                //     ->color(fn ($state) => match ($state) {
                //             'not_started' => 'gray',
                //             'in_progress' => 'info',
                //             'completed' => 'success',
                //             'on_hold' => 'warning',
                //             'cancelled' => 'danger',
                //             default => 'gray',
                //     })
                //      ->formatStateUsing(fn (string $state): string => match ($state) {
                //         'not_started' => __('project.status_not_started'),
                //         'in_progress' => __('project.status_in_progress'),
                //         'completed' => __('project.status_completed'),
                //         'on_hold' => __('project.status_on_hold'),
                //         'cancelled' => __('project.status_cancelled'),
                //         default => $state,
                //     })
                //     ->sortable(),
                // TextColumn::make('start_date')
                //     ->label(__('project.start_date'))
                //     ->date('j-M-Y'),
                // TextColumn::make('due_date')
                //     ->label(__('project.due_date'))
                //     ->date('j-M-Y'),
            // ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->filtersFormColumns(5)
            ->filters([
                SelectFilter::make('title')
                    ->label(__('project.title'))
                    ->options(fn () => Project::pluck('title', 'title')->toArray())
                    ->preload()
                    ->searchable(),
                SelectFilter::make('client_id')
                    ->label(__('project.client'))
                    ->relationship('client', 'name')
                    ->preload()
                    ->searchable(),
                SelectFilter::make('status')
                    ->label(__('project.status'))
                    ->options([
                        'not_started' => __('project.status_not_started'),
                        'in_progress' => __('project.status_in_progress'),
                        'completed' => __('project.status_completed'),
                        'on_hold' => __('project.status_on_hold'),
                        'cancelled' => __('project.status_cancelled'),
                    ])
                    ->preload(),
                Filter::make('start_date')
                    ->label(__('project.start_date'))
                    ->form([
                        DatePicker::make('start_date_from')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('project.start_date_from')),
                        DatePicker::make('start_date_to')
                            ->displayFormat('d/mm/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label(__('project.start_date_to')),
                    ])
                    ->columnSpan(2)
                    ->columns(2)
                    ->query(function (Builder $query, array $data) {
                        if ($data['start_date_from'] ?? null) {
                            $query->whereDate('start_date', '>=', $data['start_date_from']);
                        }
                        if ($data['start_date_to'] ?? null) {
                            $query->whereDate('start_date', '<=', $data['start_date_to']);
                        }
                    }),

            ], layout: FiltersLayout::AboveContent)
            ->toolbarActions([
            ]);
    }
}
