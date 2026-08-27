<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')
                ->constrained('organizations')
                ->cascadeOnDelete();

            $table->foreignId('contract_id')
                ->constrained('contracts')
                ->restrictOnDelete();

            $table->string('invoice_number', 50)
                ->unique();

            $table->date('billing_period');

            $table->decimal('amount', 15, 2);

            $table->date('due_date');

            $table->string('status', 30)
                ->default('pending');

            $table->timestamp('paid_at')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'contract_id',
                'billing_period',
            ]);
        });

        DB::statement("
            ALTER TABLE invoices
            ADD CONSTRAINT invoices_status_check
            CHECK (
                status IN (
                    'pending',
                    'paid',
                    'overdue',
                    'cancelled'
                )
            )
        ");

        DB::statement("
            ALTER TABLE invoices
            ADD CONSTRAINT invoices_amount_check
            CHECK (
                amount >= 0
            )
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};