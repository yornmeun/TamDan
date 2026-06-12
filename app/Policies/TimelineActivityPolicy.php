<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TimelineActivity;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimelineActivityPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_timeline::activity');
    }

    public function view(AuthUser $authUser, TimelineActivity $timelineActivity): bool
    {
        return $authUser->can('view_timeline::activity');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_timeline::activity');
    }

    public function update(AuthUser $authUser, TimelineActivity $timelineActivity): bool
    {
        return $authUser->can('update_timeline::activity');
    }

    public function delete(AuthUser $authUser, TimelineActivity $timelineActivity): bool
    {
        return $authUser->can('delete_timeline::activity');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_timeline::activity');
    }

    public function restore(AuthUser $authUser, TimelineActivity $timelineActivity): bool
    {
        return $authUser->can('restore_timeline::activity');
    }

}