<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
    $table->id();

    $table->foreignId('organization_id')
        ->constrained('organizations')
        ->cascadeOnDelete();

    $table->foreignId('user_id')
        ->unique()
        ->constrained('users')
        ->cascadeOnDelete();

    $table->string('name', 150);

    $table->string('email', 150)
        ->nullable();

    $table->string('phone', 30)
        ->nullable();

    $table->string('identity_number', 100)
        ->nullable();

    $table->string('identity_photo', 255)
        ->nullable();

    $table->string('photo', 255)
        ->nullable();

    $table->text('address')
        ->nullable();

    $table->string('emergency_contact_name', 150)
        ->nullable();

    $table->string('emergency_contact_phone', 30)
        ->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
