<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('delivery_type_id')->nullable()->after('address')->constrained('delivery_types')->onDelete('set null');
            $table->boolean('is_paid')->default(false)->after('delivery_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['delivery_type_id']);
            $table->dropColumn(['delivery_type_id', 'is_paid']);
        });
    }
};
