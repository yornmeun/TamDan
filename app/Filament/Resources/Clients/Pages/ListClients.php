<?php

namespace App\Filament\Resources\Clients\Pages;

use App\Filament\Resources\Clients\ClientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\Client;
use Filament\Actions\Action;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;
    // protected string $view = 'clients.list-clients';
    // public int | string $perPage = 10;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label(__('client.create_client')),
        ];
    }

    // public function getViewData(): array
    // {
    //     return [
    //         'clients' => Client::query()
    //             ->withCount('projects')
    //             ->withSum('invoices', 'paid_amount')
    //             ->withSum('invoices', 'due_amount')
    //             ->paginate($this->perPage),
    //     ];
    // }

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->label('Delete')
            ->icon('heroicon-o-trash')
            ->iconButton()
             ->extraAttributes([
                'class' => 'bg-red-100 ml-0',
            ])
            ->color('danger')
            ->requiresConfirmation()
            ->modalCancelActionLabel(__('admin.cancel'))
            ->action(function (array $arguments) {
                Client::findOrFail($arguments['client'])->delete();
            });
    }
}
