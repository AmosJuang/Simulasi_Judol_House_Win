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
            $table->boolean('is_admin')->default(false);
            $table->enum('forced_next_result', ['win', 'lose', 'normal'])->default('normal');
            $table->integer('forced_results_remaining')->default(0);
            $table->text('admin_notes')->nullable();
        });

        // Create admin controls table
        Schema::create('admin_controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id');
            $table->enum('control_type', ['force_win', 'force_lose', 'reset_attempts']);
            $table->integer('times_to_apply')->default(1);
            $table->text('reason')->nullable();
            $table->boolean('is_applied')->default(false);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_controls');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'forced_next_result', 'forced_results_remaining', 'admin_notes']);
        });
    }
};
