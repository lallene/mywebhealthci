<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiteToTransactionMedicamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_medicaments', function (Blueprint $table) {
            $table->unsignedBigInteger('site_id')->after('stock_id');

        // Clé étrangère vers la table sites
        $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_medicaments', function (Blueprint $table) {
            $table->dropForeign(['site_id']);
        $table->dropColumn('site_id');
        });
    }
}
