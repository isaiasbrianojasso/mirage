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
        Schema::table('carriers', function (Blueprint $table) {
            $table->enum('billing_behavior', ['price', 'weight'])->default('price');
            $table->enum('out_of_range_behavior', ['highest_range', 'disable'])->default('highest_range');
            $table->decimal('max_width', 10, 2)->nullable();
            $table->decimal('max_height', 10, 2)->nullable();
            $table->decimal('max_depth', 10, 2)->nullable();
            $table->decimal('max_weight', 10, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('carriers', function (Blueprint $table) {
            $table->dropColumn(['billing_behavior', 'out_of_range_behavior', 'max_width', 'max_height', 'max_depth', 'max_weight']);
        });
    }

};
