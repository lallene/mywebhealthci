<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicaments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('type');
            $table->string('designation');
            $table->string('details')->nullable();
            $table->integer('quantite')->default(0);
            $table->integer('etat')->default(0);

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
        Schema::dropIfExists('medicaments');
    }
}
