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
        Schema::create('maintenance_photos', function (Blueprint $table) {
    $table->id();

    $table->foreignId('maintenance_request_id')
        ->constrained('maintenance_requests')
        ->cascadeOnDelete();

    $table->string('file_path', 255);

    $table->timestamp('created_at')
        ->useCurrent();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_photos');
    }
};
