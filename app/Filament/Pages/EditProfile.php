<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    protected function getFormActions(): array
    {
        $actions = parent::getFormActions();

        $actions[1]->label(__('admin.cancel'));           // Cancel

        return $actions;
    }
}
