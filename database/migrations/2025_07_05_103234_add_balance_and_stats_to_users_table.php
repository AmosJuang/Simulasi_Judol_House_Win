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
            $table->decimal('balance', 15, 2)->default(100000.00); // Saldo awal 100rb
            $table->integer('total_attempts')->default(0);
            $table->integer('total_wins')->default(0);
            $table->integer('total_losses')->default(0);
            $table->timestamp('last_played_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['balance', 'total_attempts', 'total_wins', 'total_losses', 'last_played_at']);
        });
    }
};
