<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
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

            $table->string('contract_number', 50)
                ->unique();

            $table->date('start_date');

            $table->date('end_date');

            $table->decimal('monthly_rent', 15, 2);

            $table->decimal('deposit', 15, 2)
                ->default(0);

            $table->integer('payment_day')
                ->default(1);

            $table->string('status', 30)
                ->default('active');

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });

        DB::statement("
            ALTER TABLE contracts
            ADD CONSTRAINT contracts_status_check
            CHECK (
                status IN (
                    'draft',
                    'active',
                    'expired',
                    'terminated'
                )
            )
        ");

        DB::statement("
            ALTER TABLE contracts
            ADD CONSTRAINT contracts_date_check
            CHECK (
                end_date > start_date
            )
        ");

        DB::statement("
            ALTER TABLE contracts
            ADD CONSTRAINT contracts_payment_day_check
            CHECK (
                payment_day BETWEEN 1 AND 28
            )
        ");

        DB::statement("
            ALTER TABLE contracts
            ADD CONSTRAINT contracts_rent_check
            CHECK (
                monthly_rent >= 0
            )
        ");

        DB::statement("
            ALTER TABLE contracts
            ADD CONSTRAINT contracts_deposit_check
            CHECK (
                deposit >= 0
            )
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};