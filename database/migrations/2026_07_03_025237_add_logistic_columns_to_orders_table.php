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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('delivery_address_id')->nullable()->constrained('addresses')->onDelete('set null');
            $table->foreignId('invoice_address_id')->nullable()->constrained('addresses')->onDelete('set null');
            $table->foreignId('carrier_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('total_weight', 10, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['delivery_address_id']);
            $table->dropForeign(['invoice_address_id']);
            $table->dropForeign(['carrier_id']);
            $table->dropColumn(['delivery_address_id', 'invoice_address_id', 'carrier_id', 'total_weight']);
        });
    }

};
