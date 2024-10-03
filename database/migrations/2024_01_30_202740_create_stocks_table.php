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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('prod_name');
            $table->string('prod_description')->nullable();
            $table->string('prod_reference')->nullable();
            $table->string('prod_batch')->nullable();
            $table->integer('prod_quantity');
            $table->float('prod_width', 8, 2)->nullable();
            $table->float('prod_length', 8, 2)->nullable();
            $table->float('prod_height', 8, 2)->nullable();
            $table->decimal('prod_purchase_value', 12, 2);
            $table->decimal('prod_selling_value', 12, 2);
            $table->uuid('created_by');
            $table->uuid('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
