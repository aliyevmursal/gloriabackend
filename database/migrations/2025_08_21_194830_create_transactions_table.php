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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('txpg_id')->unique()->comment('Transaction PG ID');
            $table->text('hpp_url')->nullable()->comment('Hosted Payment Page URL');
            $table->string('password')->nullable()->comment('Transaction Password');
            $table->string('status')->default('pending')->comment('Transaction Status');
            $table->text('secret')->nullable()->comment('Transaction Secret');
            $table->string('cvv_2_auth_status')->comment('CVV 2 Authentication Status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
