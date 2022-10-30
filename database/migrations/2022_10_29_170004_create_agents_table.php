<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('iris')->unique();
            $table->string('entite')->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->date('dateembauche');
            $table->integer('manager')->nullable();

            $table->unsignedBigInteger('projet_id')->nullable();
            $table->foreign('projet_id')
                ->references('id')
                ->on('projets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('emploi_id')->nullable();
            $table->foreign('emploi_id')
                ->references('id')
                ->on('emplois')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('sub_fonction_id')->nullable();
            $table->foreign('sub_fonction_id')
                ->references('id')
                ->on('sub_fonctions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('contrat_id')->nullable();
            $table->foreign('contrat_id')
                ->references('id')
                ->on('contrats')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('societe_id')->nullable();
            $table->foreign('societe_id')
                ->references('id')
                ->on('societes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('medicament_id')->nullable();
            $table->foreign('medicament_id')
                ->references('id')
                ->on('medicaments')
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
        Schema::dropIfExists('agents');
    }
}
