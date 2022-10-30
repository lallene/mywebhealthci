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
            $table->id();
            $table->enum('statut', ['interne', 'externe'])->default('interne');
            $table->string('acident_travail');
            $table->string('traitement_adm');
            $table->string('medoc_adm');
            $table->string('arret_maladie');
            $table->enum('duree_arret', ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24']);
            $table->date("date_dbt_arret");
            $table->date('date_repise_trvl');
            $table->string('nbre_jours');
            $table->enum('statut_arret', ['interne', 'externe'])->default('interne');
            $table->string('billet_sortie');
            $table->enum('covid', ['positif', 'negatif'])->default('negatif');
            $table->enum('repris_service', ['apte', 'inapte'])->default('apte');
            $table->string('vaccin_covid');
            $table->enum('dose_covid', ['1', '2', '3', '4']);
            $table->string('observation');
            $table->timestamps();
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



















