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
        Schema::create('texts_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('receiver')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->text('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('texts_users');
    }
};
