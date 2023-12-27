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
        Schema::create('FirebaseConfig', function (Blueprint $table) {
            $table->id();
            $table->string('apiKey');
            $table->string('authDomain');
            $table->string('databaseURL');
            $table->string('projectId');
            $table->string('storageBocket');
            $table->string('messagingSenderId');
            $table->string('appId');
            $table->string('measurementId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('FirebaseConfig');
    }
};
