<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Pengajuan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengajuanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Pengajuan');
    }

    public function view(AuthUser $authUser, Pengajuan $pengajuan): bool
    {
        return $authUser->can('View:Pengajuan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Pengajuan');
    }

    public function update(AuthUser $authUser, Pengajuan $pengajuan): bool
    {
        return $authUser->can('Update:Pengajuan');
    }

    public function delete(AuthUser $authUser, Pengajuan $pengajuan): bool
    {
        return $authUser->can('Delete:Pengajuan');
    }

    public function restore(AuthUser $authUser, Pengajuan $pengajuan): bool
    {
        return $authUser->can('Restore:Pengajuan');
    }

    public function forceDelete(AuthUser $authUser, Pengajuan $pengajuan): bool
    {
        return $authUser->can('ForceDelete:Pengajuan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Pengajuan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Pengajuan');
    }

    public function replicate(AuthUser $authUser, Pengajuan $pengajuan): bool
    {
        return $authUser->can('Replicate:Pengajuan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Pengajuan');
    }

}