<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('computer_formatting', function (Blueprint $table) {
            $table->id();
            $table->string('computer_name');
            $table->string('computer_status');
            $table->string('computer_type');
            $table->foreignId('assignment_id')->constrained('assignments')->cascadeOnDelete();
            $table->string('situation')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computer_formatting');
    }
};
