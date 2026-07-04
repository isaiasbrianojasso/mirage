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
        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('quantity_refunded')->default(0)->after('quantity');
            $table->decimal('amount_refunded', 12, 2)->default(0)->after('quantity_refunded');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['quantity_refunded', 'amount_refunded']);
        });
    }

};
