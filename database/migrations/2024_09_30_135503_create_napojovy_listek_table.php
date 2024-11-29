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
        Schema::create('napojovy_listek', function (Blueprint $table) {
            $table->id();
            $table->string("nazev");
            $table->string("popis");
            $table->integer("cena");
            $table->tinyInteger("aktivni")->default(1);
            $table->unsignedBigInteger(column: 'kategorie_id');
            $table->unsignedBigInteger(column: 'user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kategorie_id')->references('id')->on('kategorie')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('napojovy_listek');
    }
};
