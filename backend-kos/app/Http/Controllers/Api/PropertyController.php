<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        $properties = $organization
            ->properties()
            ->with('photos')
            ->latest()
            ->get();

        return response()->json([
            'properties' => $properties,
        ]);
    }

    public function store(Request $request)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'address' => ['required', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $property = $organization->properties()->create($validated);

        return response()->json([
            'message' => 'Property created successfully.',
            'property' => $property,
        ], 201);
    }

    public function show(Request $request, Property $property)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        if ($property->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Property not found.',
            ], 404);
        }

        $property->load([
            'photos',
            'rooms',
        ]);

        return response()->json([
            'property' => $property,
        ]);
    }

    public function update(
        Request $request,
        Property $property
    ) {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        if ($property->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Property not found.',
            ], 404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'address' => ['required', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $property->update($validated);

        return response()->json([
            'message' => 'Property updated successfully.',
            'property' => $property->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        Property $property
    ) {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        if ($property->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Property not found.',
            ], 404);
        }

        $property->delete();

        return response()->json([
            'message' => 'Property deleted successfully.',
        ]);
    }
}