<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdonnancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordonnances', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->id();
            $table->string('typeMedicament');
            $table->string('natureMedicament');
            $table->string('qte');
            $table->string('joursTraitement');

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
        Schema::dropIfExists('consultations');
    }
}



















