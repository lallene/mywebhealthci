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

            $table->string('poids')->default('-');
            $table->string('poul')->default('-');
            $table->string('temperature')->default('-');
            $table->string('tension')->default('-');
            $table->string('mat_Ascoma')->default('non');
            $table->string('traitementAdmin')->default('non');
            $table->float('duree_arret')->nullable();
            $table->string("nbrJour")->comment('Unité de mesure du temps d\'arrête');
            $table->date('debutArret')->nullable();
            $table->date('dateReprise')->nullable();
            $table->string('repriseService')->default('-');
            $table->string('maladie_contagieuse');
            $table->string('maladie_prof')->default('non');
            $table->string('accidentPro')->default('non');
            $table->string('vaccin_covid')->default('-');
            $table->string('testCovid')->default('non');
            $table->integer('doseVaccinCovid')->default('0');
            $table->text('observation');
            $table->string('nomMedecin')->default('-');
            $table->string('designationCentreExterne')->default('-');
            $table->string('typeArrêt');
            $table->string('natureDuree');
            $table->string('AutreMotif');
            $table->string('motifRejet')->default('-');
            $table->string('soinadministre')->default('non');
            $table->string('typeConsultation')->nullable();
            $table->date('dateConsultation')->nullable();
            $table->unsignedBigInteger('projet_id');
            $table->foreign('projet_id')
                ->references('id')
                ->on('projets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('motif_consultation_id')->nullable();
            $table->foreign('motif_consultation_id')
                ->references('id')
                ->on('motif_consultations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('siteConsultation')->nullable();

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



















