<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_paiements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('paiement_id');
            $table->unsignedInteger('commande_id');
            $table->unsignedInteger('agence_id');
            $table->bigInteger('montant');
            $table->integer('created_by')->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamps();


            $table->foreign('paiement_id')->references('id')->on('paiements');
            $table->foreign('commande_id')->references('id')->on('commandes');
            $table->foreign('agence_id')->references('id')->on('agences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_paiements');
    }
}
