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
        Schema::create('shippings_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_price_has_products')->constrained('table: products', 'column:id');
            $table->string('company');
            $table->float('dimensions');
            $table->float('weight');
            $table->string('destination');
            $table->string('value');
            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings_prices');
    }
};
