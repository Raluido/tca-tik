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
        Schema::create('shippping_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_log_has_order')->constrained(table: 'orders', column: 'id');
            $table->string('tracking_number');
            $table->date('departure');
            $table->date('estimated_arrived');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippping_logs');
    }
};
