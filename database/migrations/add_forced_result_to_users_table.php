<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // This migration is no longer needed since forced_result column already exists
        // Column was already added in previous migration
    }

    public function down()
    {
        // Do nothing since we're not adding anything
    }
};