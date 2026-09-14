<?php

namespace App\Policies;

use App\Models\OrganizationApplication;
use App\Models\User;

class OrganizationApplicationPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['owner', 'tenant'], true);
    }

    public function view(User $user, OrganizationApplication $application): bool
    {
        return $application->user_id === $user->id
            || $application->organization->owner_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->role === 'tenant' && ! $user->tenant()->exists();
    }

    public function review(User $user, OrganizationApplication $application): bool
    {
        return $user->role === 'owner'
            && $application->organization->owner_id === $user->id
            && $application->status === 'pending';
    }
}
