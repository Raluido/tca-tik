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
        Schema::create('tickets_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_reply_has_ticket')->constrained(table: 'tickets', column: 'id');
            $table->foreignId('ticket_has_user')->constrained(table: 'users', column: 'id');
            $table->longtext("description");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_replies');
    }
};
