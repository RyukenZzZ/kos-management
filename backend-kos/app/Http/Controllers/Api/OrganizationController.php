<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    public function show(Request $request)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        return response()->json([
            'organization' => $organization,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->organization) {
            return response()->json([
                'message' => 'You already have an organization.',
            ], 409);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'is_accepting_applications' => ['sometimes', 'boolean'],
        ]);

        $organization = Organization::create([
            'owner_id' => $user->id,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'is_accepting_applications' => $validated['is_accepting_applications'] ?? true,
        ]);

        return response()->json([
            'message' => 'Organization created successfully.',
            'organization' => $organization,
        ], 201);
    }

    public function update(Request $request)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'is_accepting_applications' => ['sometimes', 'boolean'],
        ]);

        $organization->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'is_accepting_applications' => $validated['is_accepting_applications'] ?? $organization->is_accepting_applications,
        ]);

        return response()->json([
            'message' => 'Organization updated successfully.',
            'organization' => $organization->fresh(),
        ]);
    }

    public function destroy(Request $request)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        $organization->delete();

        return response()->json([
            'message' => 'Organization deleted successfully.',
        ]);
    }
}
