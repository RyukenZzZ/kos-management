<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;

class OrganizationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'owner';
    }

    public function view(User $user, Organization $organization): bool
    {
        return $user->role === 'owner' && $organization->owner_id === $user->id;
    }

    public function update(User $user, Organization $organization): bool
    {
        return $this->view($user, $organization);
    }
}
