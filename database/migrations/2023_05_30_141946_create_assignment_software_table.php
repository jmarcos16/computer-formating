<?php

use App\Models\Assignment;
use App\Models\Software;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assignment_software', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Assignment::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Software::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_software');
    }
};
