<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class RoomController extends Controller
{
    /**
     * Get all rooms from a property.
     */
    public function index(Request $request, Property $property)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        // Make sure property belongs to current owner's organization
        if ($property->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Property not found.',
            ], 404);
        }

        $rooms = $property->rooms()
            ->latest()
            ->get();

        return response()->json([
            'rooms' => $rooms,
        ]);
    }

    /**
     * Create a room.
     */
    public function store(
        Request $request,
        Property $property
    ) {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        // Make sure property belongs to current owner's organization
        if ($property->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Property not found.',
            ], 404);
        }

        $validated = $request->validate([
            'room_number' => [
                'required',
                'string',
                'max:30',
            ],
            'floor' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'deposit' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'status' => [
                'required',
                'in:available,occupied,maintenance',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $room = $property->rooms()->create($validated);

        return response()->json([
            'message' => 'Room created successfully.',
            'room' => $room,
        ], 201);
    }

    /**
     * Get a specific room.
     */
    public function show(
        Request $request,
        Property $property,
        Room $room
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

        if ($room->property_id !== $property->id) {
            return response()->json([
                'message' => 'Room not found.',
            ], 404);
        }

        return response()->json([
            'room' => $room,
        ]);
    }

    /**
     * Update a room.
     */
    public function update(
        Request $request,
        Property $property,
        Room $room
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

        if ($room->property_id !== $property->id) {
            return response()->json([
                'message' => 'Room not found.',
            ], 404);
        }

        $validated = $request->validate([
            'room_number' => [
                'sometimes',
                'string',
                'max:30',
                Rule::unique('rooms', 'room_number')
                    ->where(function ($query) use ($property) {
                        return $query->where(
                            'property_id',
                            $property->id
                        );
                    })
                    ->ignore($room->id)
            ],
            'floor' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'deposit' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'status' => [
                'required',
                'in:available,occupied,maintenance',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $room->update($validated);

        return response()->json([
            'message' => 'Room updated successfully.',
            'room' => $room->fresh(),
        ]);
    }

    /**
     * Delete a room.
     */
    public function destroy(
        Request $request,
        Property $property,
        Room $room
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

        if ($room->property_id !== $property->id) {
            return response()->json([
                'message' => 'Room not found.',
            ], 404);
        }

        $room->delete();

        return response()->json([
            'message' => 'Room deleted successfully.',
        ]);
    }
}