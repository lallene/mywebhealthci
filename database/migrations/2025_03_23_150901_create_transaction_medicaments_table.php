<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMedicamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_medicaments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultation_id');  // Consultation associée
            $table->unsignedBigInteger('medication_id');  // Medicament associé
            $table->integer('qte');  // Quantité
            $table->unsignedBigInteger('stock_id');  // Stock associé
            $table->timestamps();  // created_at et updated_at

            // Définition des clés étrangères
            $table->foreign('consultation_id')->references('id')->on('consultations')->onDelete('cascade');
            $table->foreign('medication_id')->references('id')->on('medications')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_medicaments');
    }
}
