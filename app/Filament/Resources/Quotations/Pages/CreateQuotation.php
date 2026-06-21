<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\Quotations\QuotationResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Project;

class CreateQuotation extends CreateRecord
{
    private ?int $project_id;
    protected static string $resource = QuotationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->project_id = $data['project_id'] ;

        return $data;
    }
    protected function afterCreate() 
    {
        Project::where('id', $this->project_id)->update([
            'quotation_id' => $this->record->id,
        ]);
    }
}
