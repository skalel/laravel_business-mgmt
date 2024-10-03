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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_number', 15)->nullable();
            $table->string('client_email')->nullable();
            $table->timestamp('budget_expiration_date')->nullable();
            $table->decimal('budget_value', 12, 2);
            $table->decimal('budget_with_discount', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
