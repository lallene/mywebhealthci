<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubFonctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_fonctions', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->timestamps();

            $table->unsignedBigInteger('fonction_id')->nullable();
            $table->foreign('fonction_id')
                ->references('id')
                ->on('fonctions')
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
        Schema::dropIfExists('sub_fonctions');
    }
}
