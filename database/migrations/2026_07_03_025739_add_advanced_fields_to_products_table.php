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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('wholesale_price', 10, 2)->nullable()->after('price');
            $table->decimal('weight', 10, 2)->default(0)->after('stock');
            $table->decimal('width', 10, 2)->default(0)->after('weight');
            $table->decimal('height', 10, 2)->default(0)->after('width');
            $table->decimal('depth', 10, 2)->default(0)->after('height');
            $table->decimal('additional_shipping_cost', 10, 2)->default(0)->after('depth');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'wholesale_price',
                'weight',
                'width',
                'height',
                'depth',
                'additional_shipping_cost',
                'meta_title',
                'meta_description'
            ]);
        });
    }
};
