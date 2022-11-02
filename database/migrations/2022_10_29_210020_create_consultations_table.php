<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {





            $table->engine = 'InnoDB';
            $table->id();
            $table->string('Poids');
            $table->string('poul');
            $table->string('tension');
            $table->string('tension');
            $table->string('acident_travail');
            $table->string('assurance')->default('non');
            $table->string('traitement_adm');
            $table->string('medoc_adm');
            $table->string('arret_maladie');
            $table->integer('duree_arret');
            $table->date("date_dbt_arret");
            $table->date('date_repise_trvl');
            $table->string('nbre_jours');
            $table->string('maladie_contagieuse');
            $table->string('maladie_prof');
            $table->string('statut_arret')->default('interne');
            $table->string('billet_sortie');
            $table->string('covid')->default('negatif');
            $table->string('repris_service')->default('apte');
            $table->string('vaccin_covid');
            $table->integer('dose_covid');
            $table->text('observation');
            $table->timestamps();

            $table->unsignedBigInteger('motif_consultation_id')->nullable();
            $table->foreign('motif_consultation_id')
                ->references('id')
                ->on('motif_consultations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('site_id')->nullable();
            $table->foreign('site_id')
                ->references('id')
                ->on('sites')
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
        Schema::dropIfExists('consultations');
    }
}



















