<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_task');
    }

    public function view(AuthUser $authUser, Task $task): bool
    {
        return $authUser->can('view_task');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_task');
    }

    public function update(AuthUser $authUser, Task $task): bool
    {
        return $authUser->can('update_task');
    }

    public function delete(AuthUser $authUser, Task $task): bool
    {
        return $authUser->can('delete_task');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_task');
    }

    public function restore(AuthUser $authUser, Task $task): bool
    {
        return $authUser->can('restore_task');
    }

}