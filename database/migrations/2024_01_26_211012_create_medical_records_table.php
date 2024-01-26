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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pet::class)->constrained()->onDelete('cascade');
            $table->text('medical_history')->nullable();
            $table->text('medications')->nullable();
            $table->text('allergies')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->date('spaying_neutering_date')->nullable();
            $table->text('behavioral_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
