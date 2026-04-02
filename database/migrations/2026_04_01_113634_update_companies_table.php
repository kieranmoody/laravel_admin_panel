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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('website')->nullable()->change();
            $table->string('slug')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
        $table->string('name')->nullable()->change();
        $table->string('email')->nullable(false)->change();
        $table->string('description')->nullable(false)->change();
        $table->string('website')->nullable(false)->change();
        $table->string('slug')->nullable()->change();
    });
    }
};
