<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Quotation;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotationPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_quotation');
    }

    public function view(AuthUser $authUser, Quotation $quotation): bool
    {
        return $authUser->can('view_quotation');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_quotation');
    }

    public function update(AuthUser $authUser, Quotation $quotation): bool
    {
        return $authUser->can('update_quotation');
    }

    public function delete(AuthUser $authUser, Quotation $quotation): bool
    {
        return $authUser->can('delete_quotation');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_quotation');
    }

    public function restore(AuthUser $authUser, Quotation $quotation): bool
    {
        return $authUser->can('restore_quotation');
    }

}