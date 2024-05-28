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
        Schema::create('friends_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('receiver')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->enum('status', ['Pending', 'Accepted']);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends_users');
    }
};
