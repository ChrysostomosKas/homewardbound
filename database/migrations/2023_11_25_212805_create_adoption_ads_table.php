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
        Schema::create('adoption_ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            /** ENUM */
            $table->string('type_of_pet');
            /** ENUM */
            $table->string('breed')->nullable();
            $table->integer('age')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('vaccination_status')->default(false);
            $table->boolean('spaying_neutering_status')->default(false);
            $table->text('health_condition')->nullable();
            $table->string('location');
            $table->string('contact_phone_number');
            $table->string('contact_email');
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_ads');
    }
};
