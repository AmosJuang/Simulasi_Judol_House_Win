<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop duplicate/unwanted columns if they exist
            if (Schema::hasColumn('users', 'forced_next_result')) {
                $table->dropColumn('forced_next_result');
            }
            if (Schema::hasColumn('users', 'forced_results_remaining')) {
                $table->dropColumn('forced_results_remaining');
            }
            if (Schema::hasColumn('users', 'admin_notes')) {
                $table->dropColumn('admin_notes');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Restore the dropped columns if needed
            $table->enum('forced_next_result', ['win', 'lose', 'normal'])->default('normal');
            $table->integer('forced_results_remaining')->default(0);
            $table->text('admin_notes')->nullable();
        });
    }
};
