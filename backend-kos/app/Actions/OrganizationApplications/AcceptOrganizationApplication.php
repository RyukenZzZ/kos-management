<?php

namespace App\Actions\OrganizationApplications;

use App\Models\OrganizationApplication;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AcceptOrganizationApplication
{
    public function handle(OrganizationApplication $application, User $reviewer): OrganizationApplication
    {
        if (! $reviewer->can('review', $application)) {
            throw new AuthorizationException();
        }

        return DB::transaction(function () use ($application, $reviewer): OrganizationApplication {
            $application = OrganizationApplication::query()->lockForUpdate()->findOrFail($application->id);

            if ($application->status !== 'pending') {
                throw ValidationException::withMessages([
                    'application' => 'Only pending applications can be accepted.',
                ]);
            }

            $user = User::query()->lockForUpdate()->findOrFail($application->user_id);

            if ($user->role !== 'tenant' || Tenant::query()->where('user_id', $user->id)->lockForUpdate()->exists()) {
                throw ValidationException::withMessages([
                    'application' => 'This tenant is already assigned to an organization.',
                ]);
            }

            Tenant::create([
                'organization_id' => $application->organization_id,
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ]);

            $application->update([
                'status' => 'accepted',
                'reviewed_by' => $reviewer->id,
                'reviewed_at' => now(),
            ]);

            return $application->fresh(['organization', 'user', 'reviewer']);
        });
    }
}
