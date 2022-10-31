<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificatifExternesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justificatif_externes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('statut')->default('interne');
            $table->string('accident_travail');
            $table->string('traitement_adm');
            $table->string('medoc_adm');
            $table->string('arret_maladie_recu')->nullable();
            $table->integer('duree_arret');
            $table->date("date_dbt_arret");
            $table->date('date_repise_trvl');
            $table->string('nbre_jours');
            $table->string('billet_sortie');
            $table->string('covid')->default('negatif');
            $table->string('repris_service')->default('apte');
            $table->string('vaccin_covid');
            $table->string('dose_covid')->nullable();
            $table->timestamps();
            $table->string('clinique_externe');
            $table->string('medecin_externe');
            $table->string('justif_valide')->default('oui');
            $table->string('motif_rejet')->default('Pièce incomplète');
            $table->string('duplicat_suite_valide');
            $table->unsignedBigInteger('motif_consultation_id')->nullable();
            $table->foreign('motif_consultation_id')
                ->references('id')
                ->on('motif_consultations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('maladie_contagieuse_id')->nullable();
            $table->foreign('maladie_contagieuse_id')
                ->references('id')
                ->on('maladie_contagieuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->unsignedBigInteger('maladie_prof_id')->nullable();
            $table->foreign('maladie_prof_id')
                ->references('id')
                ->on('maladie_profs')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')
                ->references('id')
                ->on('agents')
                ->onDelete('cascade')
                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('justificatif_externes');
    }
}
