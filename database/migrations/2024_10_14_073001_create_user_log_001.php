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
        Schema::create('user_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_info')->onDelete('cascade');
            $table->enum('status', ['clock_in','clock_out', 'break_in', 'break_out']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_log');
    }
};
