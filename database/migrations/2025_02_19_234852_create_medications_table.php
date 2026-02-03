<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du médicament
            $table->integer('stock_quantity'); // Quantité en stock
            $table->foreignId('site_id')->nullable()->constrained()->onDelete('cascade'); // Site affecté plus tard
            $table->integer('alert_threshold'); // Seuil d'alerte
            $table->date('expiration_date')->nullable(); // Date de péremption (peut être non définie)
            $table->string('supplier')->nullable(); // Fournisseur (optionnel)
            $table->date('supply_date')->nullable(); // Date d'approvisionnement (optionnel)
            $table->decimal('unit_price', 10, 2); // Prix unitaire
            $table->integer('tablet_count')->nullable(); // Nombre de comprimés
            $table->foreignId('distribution_type_id')->constrained('type_distributions')->onDelete('cascade'); // Type de distribution
            $table->boolean('validation')->default(false); // Ajout de la validation
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
        Schema::dropIfExists('medications');
    }
}
