<?php

namespace App\Http\Controllers\Api;

use App\Actions\OrganizationApplications\AcceptOrganizationApplication;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\OrganizationApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrganizationApplicationController extends Controller
{
    public function tenantIndex(Request $request): JsonResponse
    {
        $applications = $request->user()->applications()
            ->with('organization:id,name,slug,is_accepting_applications')
            ->latest()
            ->get();

        return response()->json(['applications' => $applications]);
    }

    public function store(Request $request, Organization $organization): JsonResponse
    {
        $this->authorize('create', OrganizationApplication::class);

        if (! $organization->is_accepting_applications) {
            throw ValidationException::withMessages([
                'organization' => 'This organization is not accepting applications.',
            ]);
        }

        $application = OrganizationApplication::firstOrCreate(
            ['organization_id' => $organization->id, 'user_id' => $request->user()->id],
            ['status' => 'pending'],
        );

        if (! $application->wasRecentlyCreated) {
            throw ValidationException::withMessages([
                'organization' => 'You have already applied to this organization.',
            ]);
        }

        return response()->json([
            'message' => 'Application submitted successfully.',
            'application' => $application->load('organization:id,name,slug'),
        ], 201);
    }

    public function ownerIndex(Request $request): JsonResponse
    {
        $organization = $request->user()->organization;

        abort_unless($organization, 404, 'Organization not found.');

        return response()->json([
            'applications' => $organization->applications()
                ->with('user:id,name,email,phone')
                ->latest()
                ->get(),
        ]);
    }

    public function accept(Request $request, OrganizationApplication $application, AcceptOrganizationApplication $accept): JsonResponse
    {
        return response()->json([
            'message' => 'Application accepted successfully.',
            'application' => $accept->handle($application, $request->user()),
        ]);
    }

    public function reject(Request $request, OrganizationApplication $application): JsonResponse
    {
        $this->authorize('review', $application);

        $application->update([
            'status' => 'rejected',
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
        ]);

        return response()->json([
            'message' => 'Application rejected successfully.',
            'application' => $application->fresh(['organization', 'user', 'reviewer']),
        ]);
    }
}
