<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\Quotations\QuotationResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Override;

class ViewQuotation extends ViewRecord
{
    protected static string $resource = QuotationResource::class;

    protected string $view = 'quotations.view-quotation';

    #[Override]
    protected function getViewData(): array
    {
        return [
            'quotation' => $this->record,
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
