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

            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')
                ->references('id')
                ->on('agents')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('poids');
            $table->string('poul');
            $table->string('temperature');
            $table->string('tension');
            $table->string('assurance')->default('non');
            $table->string('accident');
            $table->string('traitement');
            $table->string('arretMaladie');
            $table->integer('duree_arret')->nullable();
            $table->string("nbrJour")->comment('Unité de mesure du temps d\'arrête');
            $table->date('debutArret')->nullable();
            $table->date('dateReprise')->nullable();
            $table->string('repriseService')->default('apte');
            $table->string('maladie_contagieuse');
            $table->string('maladie_prof');
            $table->string('vaccin_covid');
            $table->string('testCovid');
            $table->integer('doseVaccinCovid');
            $table->text('observation');



            $table->unsignedBigInteger('motif_consultation_id')->nullable();
            $table->foreign('motif_consultation_id')
                ->references('id')
                ->on('motif_consultations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('natureReception')->nullable();

            $table->string('natureDuree');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
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



















