<?php

namespace App\Filament\Resources\Invoices\Pages;

use App\Filament\Resources\Invoices\InvoiceResource;
use Filament\Resources\Pages\ViewRecord;
use Override;
use Filament\Actions\Action;



class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected string $view = 'invoices.view-invoice';


    #[Override]
    protected function getViewData(): array
    {
        return [
            'invoice' => $this->record,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('print')
                ->label(__('quotation.print'))
                ->icon('heroicon-o-printer')
                ->url('#')
                ->extraAttributes([
                    'onclick' => 'window.print(); return false;',
                ]),
        ];
    }
}
