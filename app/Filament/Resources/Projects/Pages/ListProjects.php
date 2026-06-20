<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Project;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('project.create_project')),
        ];
    }

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->label('Delete')
            ->icon('heroicon-o-trash')
            ->iconButton()
            ->extraAttributes([
                'class' => 'bg-red-100 ml-0 mt-0',
            ])
            ->color('danger')
            ->requiresConfirmation()
            ->modalCancelActionLabel(__('admin.cancel'))
            ->action(function (array $arguments) {
                Project::findOrFail($arguments['project'])->delete();
            });
    }
}
