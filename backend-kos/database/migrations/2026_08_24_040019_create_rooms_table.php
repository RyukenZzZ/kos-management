<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_id')
                ->constrained('properties')
                ->cascadeOnDelete();

            $table->string('room_number', 30);

            $table->integer('floor')
                ->nullable();

            $table->decimal('price', 15, 2);

            $table->decimal('deposit', 15, 2)
                ->default(0);

            $table->string('status', 30)
                ->default('available');

            $table->text('description')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'property_id',
                'room_number'
            ]);
        });

        DB::statement("
            ALTER TABLE rooms
            ADD CONSTRAINT rooms_status_check
            CHECK (
                status IN (
                    'available',
                    'occupied',
                    'maintenance'
                )
            )
        ");

        DB::statement("
            ALTER TABLE rooms
            ADD CONSTRAINT rooms_price_check
            CHECK (price >= 0)
        ");

        DB::statement("
            ALTER TABLE rooms
            ADD CONSTRAINT rooms_deposit_check
            CHECK (deposit >= 0)
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};