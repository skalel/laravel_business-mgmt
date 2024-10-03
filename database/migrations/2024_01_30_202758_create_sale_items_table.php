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
        Schema::create('sale_items', function (Blueprint $table) {
          $table->foreignId('id_sale')->references('id')->on('sales');
          $table->integer('seq_product');
          $table->foreignId('id_product')->references('id')->on('stocks');
          $table->integer('quantity');
          $table->decimal('product_value', 12, 2);
          $table->integer('created_by');
          $table->integer('updated_by');
          $table->timestamps();

          $table->primary(['id_sale', 'seq_product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
