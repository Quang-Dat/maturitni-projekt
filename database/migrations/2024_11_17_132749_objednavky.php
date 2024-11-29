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
        Schema::create('objednavky', function (Blueprint $table) {
            $table->id();
            $table->string('jmeno');
            $table->string('prijmeni');
            $table->string('email');
            $table->string('telefon');
            $table->string('ulice');
            $table->string('cp');
            $table->string('psc');
            $table->string('mesto');
            $table->unsignedBigInteger(column: 'user_id');
            $table->unsignedBigInteger(column: 'typ_dopravy_id');
            $table->unsignedBigInteger(column: 'typ_platby_id');
            $table->boolean("zaplaceno")->default(false);
            $table->boolean("doruceno")->default(false);
            $table->timestamps();

            $table->foreign('typ_dopravy_id')->references('id')->on('typ_dopravy')->onDelete('cascade');
            $table->foreign('typ_platby_id')->references('id')->on('typ_platby')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objednavky');
    }
};
