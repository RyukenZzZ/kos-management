<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Get tenants belonging to owner's organization.
     */
    public function index(Request $request)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        $tenants = $organization->tenants()
            ->with('user')
            ->latest()
            ->get();

        return response()->json([
            'tenants' => $tenants,
        ]);
    }


    /**
     * Add a registered tenant to owner's organization.
     */
    public function store(Request $request)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
        ]);

        $user = User::findOrFail($validated['user_id']);

        // Make sure selected user is actually a tenant
        if ($user->role !== 'tenant') {
            return response()->json([
                'message' => 'Selected user is not a tenant.',
            ], 422);
        }

        // Make sure tenant is not already registered
        $existingTenant = Tenant::where(
            'user_id',
            $user->id
        )->first();

        if ($existingTenant) {
            return response()->json([
                'message' => 'This user is already registered as a tenant.',
            ], 422);
        }

        $tenant = $organization->tenants()->create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        return response()->json([
            'message' => 'Tenant added successfully.',
            'tenant' => $tenant->load('user'),
        ], 201);
    }


    /**
     * Show a tenant.
     */
    public function show(
        Request $request,
        Tenant $tenant
    ) {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        if ($tenant->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Tenant not found.',
            ], 404);
        }

        return response()->json([
            'tenant' => $tenant->load('user'),
        ]);
    }


    /**
     * Update tenant profile.
     */
    public function update(
        Request $request,
        Tenant $tenant
    ) {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        if ($tenant->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Tenant not found.',
            ], 404);
        }

        $validated = $request->validate([
            'name' => [
                'sometimes',
                'string',
                'max:150',
            ],

            'email' => [
                'sometimes',
                'nullable',
                'email',
                'max:150',
            ],

            'phone' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],

            'identity_number' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],

            'address' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'emergency_contact_name' => [
                'sometimes',
                'nullable',
                'string',
                'max:150',
            ],

            'emergency_contact_phone' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],
        ]);

        $tenant->update($validated);

        return response()->json([
            'message' => 'Tenant updated successfully.',
            'tenant' => $tenant->fresh()->load('user'),
        ]);
    }


    /**
     * Remove tenant from organization.
     */
    public function destroy(
        Request $request,
        Tenant $tenant
    ) {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        if ($tenant->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Tenant not found.',
            ], 404);
        }

        $tenant->delete();

        return response()->json([
            'message' => 'Tenant removed from organization successfully.',
        ]);
    }

    public function availableUsers()
{
    $users = User::where('role', 'tenant')
        ->whereDoesntHave('tenant')
        ->select([
            'id',
            'name',
            'email',
            'phone',
        ])
        ->get();

    return response()->json([
        'users' => $users,
    ]);
}
}