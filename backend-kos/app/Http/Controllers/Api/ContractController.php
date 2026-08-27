<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    /**
     * Get contracts belonging to owner's organization.
     */
    public function index(Request $request)
    {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        $contracts = $organization->contracts()
            ->with([
                'room',
                'tenant.user',
            ])
            ->latest()
            ->get();

        return response()->json([
            'contracts' => $contracts,
        ]);
    }


    /**
     * Create a new contract.
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
            'room_id' => [
                'required',
                'integer',
                'exists:rooms,id',
            ],

            'tenant_id' => [
                'required',
                'integer',
                'exists:tenants,id',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'required',
                'date',
                'after:start_date',
            ],

            'monthly_rent' => [
                'required',
                'numeric',
                'min:0',
            ],

            'deposit' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'payment_day' => [
                'required',
                'integer',
                'between:1,28',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Room belongs to Organization
        |--------------------------------------------------------------------------
        */

        $room = Room::where('id', $validated['room_id'])
            ->whereHas('property', function ($query) use ($organization) {
                $query->where(
                    'organization_id',
                    $organization->id
                );
            })
            ->first();

        if (!$room) {
            return response()->json([
                'message' => 'Room not found in your organization.',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Tenant belongs to Organization
        |--------------------------------------------------------------------------
        */

        $tenant = Tenant::where('id', $validated['tenant_id'])
            ->where(
                'organization_id',
                $organization->id
            )
            ->first();

        if (!$tenant) {
            return response()->json([
                'message' => 'Tenant not found in your organization.',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Check Room Status
        |--------------------------------------------------------------------------
        */

        if ($room->status !== 'available') {
            return response()->json([
                'message' => 'Room is not available.',
                'room_status' => $room->status,
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Check overlapping contract
        |--------------------------------------------------------------------------
        */

        $overlappingContract = Contract::where(
            'room_id',
            $room->id
        )
            ->whereIn('status', [
                'draft',
                'active',
            ])
            ->where(function ($query) use ($validated) {

                $query->where(
                    'start_date',
                    '<=',
                    $validated['end_date']
                )->where(
                        'end_date',
                        '>=',
                        $validated['start_date']
                    );

            })
            ->exists();

        if ($overlappingContract) {
            return response()->json([
                'message' => 'Room already has a contract in this period.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Create Contract
        |--------------------------------------------------------------------------
        */

        $contract = DB::transaction(function () use ($organization, $room, $tenant, $validated) {

            $contract = Contract::create([
                'organization_id' => $organization->id,
                'room_id' => $room->id,
                'tenant_id' => $tenant->id,

                'contract_number' =>
                    'CTR-' . strtoupper(Str::random(10)),

                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],

                'monthly_rent' =>
                    $validated['monthly_rent'],

                'deposit' =>
                    $validated['deposit'] ?? 0,

                'payment_day' =>
                    $validated['payment_day'],

                'status' => 'active',

                'notes' =>
                    $validated['notes'] ?? null,
            ]);

            $room->update([
                'status' => 'occupied',
            ]);

            return $contract;
        });

        return response()->json([
            'message' => 'Contract created successfully.',
            'contract' => $contract->load([
                'room',
                'tenant.user',
            ]),
        ], 201);
    }

    public function show(
        Request $request,
        Contract $contract
    ) {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        if ($contract->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Contract not found.',
            ], 404);
        }

        return response()->json([
            'contract' => $contract->load([
                'room.property',
                'tenant.user',
                'organization',
                'invoices',
            ]),
        ]);
    }

    public function update(
        Request $request,
        Contract $contract
    ) {
        $organization = $request->user()->organization;

        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found.',
            ], 404);
        }

        if ($contract->organization_id !== $organization->id) {
            return response()->json([
                'message' => 'Contract not found.',
            ], 404);
        }

        if ($contract->status !== 'active') {
            return response()->json([
                'message' => 'Only active contracts can be updated.',
            ], 422);
        }

        $validated = $request->validate([
            'start_date' => [
                'sometimes',
                'date',
            ],

            'end_date' => [
                'sometimes',
                'date',
                'after:start_date',
            ],

            'monthly_rent' => [
                'sometimes',
                'numeric',
                'min:0',
            ],

            'deposit' => [
                'sometimes',
                'numeric',
                'min:0',
            ],

            'payment_day' => [
                'sometimes',
                'integer',
                'between:1,28',
            ],

            'notes' => [
                'sometimes',
                'nullable',
                'string',
            ],
        ]);

        $contract->update($validated);

        return response()->json([
            'message' => 'Contract updated successfully.',
            'contract' => $contract->fresh()->load([
                'room',
                'tenant.user',
            ]),
        ]);
    }
}