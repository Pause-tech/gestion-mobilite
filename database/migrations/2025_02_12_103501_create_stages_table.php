<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('stages', function (Blueprint $table) {
        $table->id();
        $table->string('titre'); // Nom du stage
        $table->text('description'); // Détails du stage
        $table->string('etablissement'); // Lieu ou université du stage
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};

