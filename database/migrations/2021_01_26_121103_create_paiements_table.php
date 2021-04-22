<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle');
            $table->string('num_facture');
            $table->unsignedInteger('agence_id')->nullable();
            $table->unsignedInteger('type_paiement_id');
            $table->enum('statut', ['ACTIVE','SUPPRIMER','DESACTIVE'])->default('ACTIVE');
            $table->integer('created_by')->nullable();
            $table->timestamps();

            $table->foreign('agence_id')->references('id')->on('agences');
            $table->foreign('type_paiement_id')->references('id')->on('type_paiements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiements');
    }
}
