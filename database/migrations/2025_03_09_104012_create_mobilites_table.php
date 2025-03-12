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
        Schema::create('mobilites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clé étrangère vers l'utilisateur
            $table->string('pays_destination');
            $table->string('universite_accueil');
            $table->string('ville')->nullable(); // Ajout direct
            $table->date('date_debut')->nullable(); // Ajout direct
            $table->date('date_fin')->nullable(); // Ajout direct
            $table->text('motivation');
            $table->string('justificatif')->nullable(); // Ajout direct
            $table->string('status')->default('en attente'); // Statut : en attente, acceptée, refusée
            $table->text('motif_refus')->nullable(); // Ajout du champ de refus
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobilites');
    }
};
