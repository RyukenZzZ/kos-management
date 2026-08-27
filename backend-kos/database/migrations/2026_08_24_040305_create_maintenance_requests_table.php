<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')
                ->constrained('organizations')
                ->cascadeOnDelete();

            $table->foreignId('room_id')
                ->constrained('rooms')
                ->restrictOnDelete();

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->restrictOnDelete();

            $table->string('title', 150);

            $table->text('description');

            $table->string('priority', 30)
                ->default('medium');

            $table->string('status', 30)
                ->default('pending');

            $table->timestamp('resolved_at')
                ->nullable();

            $table->timestamps();
        });

        DB::statement("
            ALTER TABLE maintenance_requests
            ADD CONSTRAINT maintenance_priority_check
            CHECK (
                priority IN (
                    'low',
                    'medium',
                    'high',
                    'urgent'
                )
            )
        ");

        DB::statement("
            ALTER TABLE maintenance_requests
            ADD CONSTRAINT maintenance_status_check
            CHECK (
                status IN (
                    'pending',
                    'in_progress',
                    'completed',
                    'cancelled'
                )
            )
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};