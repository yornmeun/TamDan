<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\Quotations\QuotationResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\Project;


class EditQuotation extends EditRecord
{
    protected static string $resource = QuotationResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['project_id'] = Project::where('quotation_id', $data['id'])->latest()->first()->id ?? null;
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        Project::where('id', $data['project_id'])->update([
            'quotation_id' => $this->record->id,
        ]);

        return $data;
    }

}
