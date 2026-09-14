<?php

use App\Models\Organization;
use App\Models\OrganizationApplication;
use App\Models\Tenant;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

function ownerOrganization(): array
{
    $owner = User::factory()->create(['role' => 'owner']);
    $organization = Organization::create([
        'owner_id' => $owner->id,
        'name' => 'Example Residence',
        'slug' => 'example-residence-'.$owner->id,
    ]);

    return [$owner, $organization];
}

test('a tenant can browse organizations and submit a pending application', function () {
    [, $organization] = ownerOrganization();
    $tenant = User::factory()->create(['role' => 'tenant']);

    Sanctum::actingAs($tenant);

    $this->getJson('/api/organizations?search=Example')
        ->assertOk()
        ->assertJsonPath('data.0.id', $organization->id);

    $this->postJson("/api/organizations/{$organization->id}/applications")
        ->assertCreated()
        ->assertJsonPath('application.status', 'pending');

    $this->assertDatabaseHas('organization_applications', [
        'organization_id' => $organization->id,
        'user_id' => $tenant->id,
        'status' => 'pending',
    ]);
});

test('a tenant cannot apply when an organization is not accepting applications', function () {
    [, $organization] = ownerOrganization();
    $organization->update(['is_accepting_applications' => false]);
    $tenant = User::factory()->create(['role' => 'tenant']);

    Sanctum::actingAs($tenant);

    $this->postJson("/api/organizations/{$organization->id}/applications")
        ->assertUnprocessable()
        ->assertJsonValidationErrors('organization');
});

test('an owner only sees and can review applications for their organization', function () {
    [$owner, $organization] = ownerOrganization();
    [, $otherOrganization] = ownerOrganization();
    $tenant = User::factory()->create(['role' => 'tenant']);
    $otherTenant = User::factory()->create(['role' => 'tenant']);

    $application = OrganizationApplication::create([
        'organization_id' => $organization->id,
        'user_id' => $tenant->id,
    ]);
    $otherApplication = OrganizationApplication::create([
        'organization_id' => $otherOrganization->id,
        'user_id' => $otherTenant->id,
    ]);

    Sanctum::actingAs($owner);

    $this->getJson('/api/organization-applications')
        ->assertOk()
        ->assertJsonCount(1, 'applications')
        ->assertJsonPath('applications.0.id', $application->id);

    $this->postJson("/api/organization-applications/{$otherApplication->id}/accept")
        ->assertForbidden();
});

test('accepting an application creates the tenant membership only after approval', function () {
    [$owner, $organization] = ownerOrganization();
    $tenant = User::factory()->create(['role' => 'tenant', 'phone' => '0812345678']);
    $application = OrganizationApplication::create([
        'organization_id' => $organization->id,
        'user_id' => $tenant->id,
    ]);

    expect(Tenant::where('user_id', $tenant->id)->exists())->toBeFalse();

    Sanctum::actingAs($owner);

    $this->postJson("/api/organization-applications/{$application->id}/accept")
        ->assertOk()
        ->assertJsonPath('application.status', 'accepted');

    $this->assertDatabaseHas('tenants', [
        'organization_id' => $organization->id,
        'user_id' => $tenant->id,
    ]);
});
