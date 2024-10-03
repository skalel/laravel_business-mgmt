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
        Schema::create('budget_items', function (Blueprint $table) {
            $table->foreignId('id_budget')->references('id')->on('budgets');
            $table->integer('seq_product');
            $table->foreignId('id_product')->references('id')->on('stocks');
            $table->integer('quantity');
            $table->decimal('product_value', 12, 2);
            $table->uuid('created_by');
            $table->uuid('updated_by');
            $table->timestamps();

            $table->primary(['id_budget', 'seq_product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_items');
    }
};
