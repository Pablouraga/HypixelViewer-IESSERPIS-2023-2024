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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 50);
            $table->string('text', 255);
            $table->string('sender_email', 40);
            $table->enum('status', ['Read', 'NotRead'])->default('NotRead');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
