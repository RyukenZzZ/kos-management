<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')
                ->constrained('invoices')
                ->restrictOnDelete();

            $table->string('transaction_id', 150)
                ->nullable();

            $table->decimal('amount', 15, 2);

            $table->string('payment_method', 50)
                ->nullable();

            $table->string('status', 30)
                ->default('pending');

            $table->timestamp('paid_at')
                ->nullable();

            $table->string('proof_path', 255)
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });

        DB::statement("
            ALTER TABLE payments
            ADD CONSTRAINT payments_status_check
            CHECK (
                status IN (
                    'pending',
                    'success',
                    'failed',
                    'expired'
                )
            )
        ");

        DB::statement("
            ALTER TABLE payments
            ADD CONSTRAINT payments_amount_check
            CHECK (
                amount > 0
            )
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};