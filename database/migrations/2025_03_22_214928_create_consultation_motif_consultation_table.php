<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationMotifConsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_motif_consultation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id') // Clé étrangère pour Consultation
                  ->constrained() // Contrainte sur la table 'consultations'
                  ->onDelete('cascade'); // Si la consultation est supprimée, la ligne est aussi supprimée
            $table->foreignId('motif_consultation_id') // Clé étrangère pour MotifConsultation
                  ->constrained() // Contrainte sur la table 'motif_consultations'
                  ->onDelete('cascade'); // Si le motif de consultation est supprimé, la ligne est aussi supprimée
            $table->timestamps(); // pour garder une trace de la date de création et de mise à jour
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultation_motif_consultation');
    }
}
