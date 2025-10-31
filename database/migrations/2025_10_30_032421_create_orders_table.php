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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("order_code")->nullable();
            $table->date("order_date")->nullable();
            $table->decimal("order_amount", 10, 2)->nullable();
            $table->decimal("order_subtotal", 10, 2)->nullable();
            $table->decimal("order_change", 10, 2)->nullable();
            $table->tinyInteger("order_status")->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
