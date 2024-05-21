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
        //
        Schema::create('favourites_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_who_adds')->constrained('users')->onDelete('cascade');;
            $table->foreignId('user_added')->constrained('users')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourites_users');
    }
};
