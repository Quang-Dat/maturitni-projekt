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
        Schema::create('prod_v_obj', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'stale_menu_id');
            $table->unsignedBigInteger(column: 'objednavky_id');
            $table->integer("pocet");
            $table->integer("cena");
            $table->timestamps();

            $table->foreign('stale_menu_id')->references('id')->on('stale_menu')->onDelete('cascade');
            $table->foreign('objednavky_id')->references('id')->on('objednavky')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prod_v_obj');
    }
};
