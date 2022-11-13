<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justificatifs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nomMedecin');
            $table->string('designationCentreExterne');
            $table->string('justificatifValide');
            $table->string('motifRejet')->nullable();
            $table->string('duplicat_suite_valide');

            $table->unsignedBigInteger('motif_consultation_id')->nullable();
            $table->foreign('motif_consultation_id')
                ->references('id')
                ->on('motif_consultations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('consultation_id')->nullable();
            $table->foreign('consultation_id')
                ->references('id')
                ->on('consultations')
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
        Schema::dropIfExists('justificatifs');
    }
}
