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
        Schema::create('players_users', function (Blueprint $table) {
            $table->foreignId('user_who_adds')->references('id')->on('users');
            $table->foreignId('user_added')->references('id')->on('players');
            $table->unique(['user_who_adds', 'user_added'], 'user_favourite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players_users');
    }
};
