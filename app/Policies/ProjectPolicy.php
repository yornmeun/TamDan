<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_project');
    }

    public function view(AuthUser $authUser, Project $project): bool
    {
        return $authUser->can('view_project');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_project');
    }

    public function update(AuthUser $authUser, Project $project): bool
    {
        return $authUser->can('update_project');
    }

    public function delete(AuthUser $authUser, Project $project): bool
    {
        return $authUser->can('delete_project');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_project');
    }

    public function restore(AuthUser $authUser, Project $project): bool
    {
        return $authUser->can('restore_project');
    }

}