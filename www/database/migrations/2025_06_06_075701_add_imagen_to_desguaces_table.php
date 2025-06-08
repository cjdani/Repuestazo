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
        Schema::table('desguaces', function (Blueprint $table) {
            $table->string('imagen')->default('fotos_desguace/default.jpg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('desguaces', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
};
