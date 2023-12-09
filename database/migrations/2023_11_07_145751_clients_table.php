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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('pays');
            $table->string('ville');
            $table->string('CIN_recto_path')->nullable();
            $table->string('CIN_verso_path')->nullable();
            $table->string('NomBanque')->nullable();
            $table->string('RIB')->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->timestamps();
            $table->decimal('badge', 8, 2)->nullable(); // Changing 'badge' to a decimal with 8 total digits and 2 decimal places
            $table->decimal('credit', 8,2)->nullable();
            $table->json('missioncomplete')->nullable();
            $table->json('payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
