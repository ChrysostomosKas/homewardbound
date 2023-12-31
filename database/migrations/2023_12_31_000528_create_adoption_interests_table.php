<?php

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use App\Models\User;
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
        Schema::create('adoption_interests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AdoptionAd::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            /** ENUM */
            $table->string('status')->default(AdoptionAdStatus::Open->name);
            /** ENUM */
            $table->string('contact_phone_number');
            $table->string('city');
            $table->string('zip_code');
            $table->string('contact_email');
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_interests');
    }
};
