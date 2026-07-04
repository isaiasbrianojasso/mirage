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
        Schema::table('users', function (Blueprint $table) {
            $table->string('social_title')->nullable()->after('id'); // Mr. o Mrs.
            $table->string('first_name')->nullable()->after('social_title');
            $table->string('last_name')->nullable()->after('first_name');
            $table->date('birthday')->nullable()->after('email');
            $table->boolean('is_enabled')->default(true)->after('birthday');
            $table->boolean('newsletter')->default(false)->after('is_enabled');
            $table->boolean('opt_in')->default(false)->after('newsletter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'social_title',
                'first_name',
                'last_name',
                'birthday',
                'is_enabled',
                'newsletter',
                'opt_in',
            ]);
        });
    }
};
