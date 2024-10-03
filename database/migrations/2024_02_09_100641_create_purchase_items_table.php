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
        Schema::create('purchase_items', function (Blueprint $table) {
          $table->foreignId('id_purchase')->references('id')->on('purchases');
          $table->integer('seq_product');
          $table->foreignId('id_product')->references('id')->on('stocks');
          $table->string('prod_name');
          $table->string('prod_description')->nullable();
          $table->string('prod_reference')->nullable();
          $table->string('prod_batch')->nullable();
          $table->decimal('prod_buy_value', 12, 2);
          $table->decimal('prod_sell_value', 12, 2);
          $table->uuid('created_by');
          $table->uuid('updated_by');
          $table->timestamps();

          $table->primary(['id_purchase', 'seq_product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
