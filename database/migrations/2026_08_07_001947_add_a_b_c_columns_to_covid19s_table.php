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
        Schema::table('covid19s', function (Blueprint $table) {
            $table->double('a')->nullable();
            $table->double('remark')->nullable();
            $table->double('c')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('covid19s', function (Blueprint $table) {
            $table->dropColumn(['a', 'remark', 'c']);
        });
    }
};