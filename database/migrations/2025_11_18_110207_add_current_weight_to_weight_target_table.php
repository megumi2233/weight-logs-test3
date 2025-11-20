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
        Schema::table('weight_target', function (Blueprint $table) {
            $table->decimal('current_weight', 4, 1)->after('user_id')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weight_target', function (Blueprint $table) {
            $table->dropColumn('current_weight');
        });
    }
};
