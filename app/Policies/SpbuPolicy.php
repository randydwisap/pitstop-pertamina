<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Spbu;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpbuPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Spbu');
    }

    public function view(AuthUser $authUser, Spbu $spbu): bool
    {
        return $authUser->can('View:Spbu');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Spbu');
    }

    public function update(AuthUser $authUser, Spbu $spbu): bool
    {
        return $authUser->can('Update:Spbu');
    }

    public function delete(AuthUser $authUser, Spbu $spbu): bool
    {
        return $authUser->can('Delete:Spbu');
    }

    public function restore(AuthUser $authUser, Spbu $spbu): bool
    {
        return $authUser->can('Restore:Spbu');
    }

    public function forceDelete(AuthUser $authUser, Spbu $spbu): bool
    {
        return $authUser->can('ForceDelete:Spbu');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Spbu');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Spbu');
    }

    public function replicate(AuthUser $authUser, Spbu $spbu): bool
    {
        return $authUser->can('Replicate:Spbu');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Spbu');
    }

}