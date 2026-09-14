<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenantOrganizationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $search = $request->string('search')->trim()->value();

        $organizations = Organization::query()
            ->select(['id', 'name', 'slug', 'phone', 'email', 'is_accepting_applications'])
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search): void {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            }))
            ->orderBy('name')
            ->paginate(15);

        return response()->json($organizations);
    }

    public function show(Organization $organization): JsonResponse
    {
        return response()->json([
            'organization' => $organization->only([
                'id',
                'name',
                'slug',
                'phone',
                'email',
                'is_accepting_applications',
            ]),
        ]);
    }
}
