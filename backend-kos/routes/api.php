<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\ContractController;
use Illuminate\Http\Request;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json([
        'user' => $request->user(),
    ]);
});

Route::middleware(['auth:sanctum', 'role:owner'])
    ->get('/owner/test', function (Request $request) {
        return response()->json([
            'message' => 'Owner access granted',
            'user' => $request->user(),
        ]);
    });

Route::middleware(['auth:sanctum', 'role:owner'])->group(function () {

    Route::get('/organization', [OrganizationController::class, 'show']);

    Route::post('/organization', [OrganizationController::class, 'store']);

    Route::put('/organization', [OrganizationController::class, 'update']);

    Route::delete('/organization', [OrganizationController::class, 'destroy']);

});

Route::middleware(['auth:sanctum', 'role:owner'])->group(function () {

    Route::apiResource(
        '/properties',
        PropertyController::class
    );

    // Rooms
    Route::apiResource(
        '/properties.rooms',
        RoomController::class
    );

    Route::get(
        '/tenant-users/available',
        [TenantController::class, 'availableUsers']
    );

    // Tenants
    Route::apiResource(
        '/tenants',
        TenantController::class
    );

     // Contracts
    Route::apiResource(
        '/contracts',
        ContractController::class
    );

});