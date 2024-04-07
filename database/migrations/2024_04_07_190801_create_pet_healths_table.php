<?php

use App\Models\Pet;
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
        Schema::create('pet_healths', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pet::class)->constrained()->onDelete('cascade');
            $table->date('bathed_at')->nullable();
            $table->string('hair_condition')->nullable();
            $table->date('last_vaccination')->nullable();
            $table->string('teeth_condition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_healths');
    }
};
