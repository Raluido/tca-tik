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
        Schema::create('product_storehouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_storehouse_has_products')->constrained(table: 'products', column: 'id');
            $table->foreignId('product_storehouse_has_storehouses')->constrained(table: 'storehouses', column: 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_storehouses');
    }
};
