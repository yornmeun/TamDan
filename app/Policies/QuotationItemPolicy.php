<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\QuotationItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotationItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_quotation::item');
    }

    public function view(AuthUser $authUser, QuotationItem $quotationItem): bool
    {
        return $authUser->can('view_quotation::item');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_quotation::item');
    }

    public function update(AuthUser $authUser, QuotationItem $quotationItem): bool
    {
        return $authUser->can('update_quotation::item');
    }

    public function delete(AuthUser $authUser, QuotationItem $quotationItem): bool
    {
        return $authUser->can('delete_quotation::item');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_quotation::item');
    }

    public function restore(AuthUser $authUser, QuotationItem $quotationItem): bool
    {
        return $authUser->can('restore_quotation::item');
    }

}