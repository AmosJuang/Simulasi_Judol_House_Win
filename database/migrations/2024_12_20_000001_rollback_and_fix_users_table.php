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
        // Drop existing problematic tables if they exist
        Schema::dropIfExists('admin_controls');
        
        // First, let's check what columns exist and clean up the users table
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Drop columns that might exist but shouldn't be there
                $columnsToRemove = [
                    'forced_next_result',
                    'forced_results_remaining', 
                    'admin_notes'
                ];
                
                foreach ($columnsToRemove as $column) {
                    if (Schema::hasColumn('users', $column)) {
                        $table->dropColumn($column);
                    }
                }
                
                // Add missing columns if they don't exist
                if (!Schema::hasColumn('users', 'balance')) {
                    $table->decimal('balance', 15, 2)->default(100000.00);
                }
                if (!Schema::hasColumn('users', 'total_attempts')) {
                    $table->integer('total_attempts')->default(0);
                }
                if (!Schema::hasColumn('users', 'total_wins')) {
                    $table->integer('total_wins')->default(0);
                }
                if (!Schema::hasColumn('users', 'total_losses')) {
                    $table->integer('total_losses')->default(0);
                }
                if (!Schema::hasColumn('users', 'last_played_at')) {
                    $table->timestamp('last_played_at')->nullable();
                }
                if (!Schema::hasColumn('users', 'is_admin')) {
                    $table->boolean('is_admin')->default(false);
                }
                if (!Schema::hasColumn('users', 'forced_result')) {
                    $table->enum('forced_result', ['win', 'lose'])->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $columnsToRemove = [
                    'balance',
                    'total_attempts',
                    'total_wins', 
                    'total_losses',
                    'last_played_at',
                    'is_admin',
                    'forced_result'
                ];
                
                foreach ($columnsToRemove as $column) {
                    if (Schema::hasColumn('users', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
