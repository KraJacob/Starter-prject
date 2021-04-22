<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreeProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entree_produits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('produit_id');
            $table->unsignedInteger('entree_id');
            $table->unsignedInteger('agence_id')->nullable();;
            $table->date('date_entree');
            $table->integer('qte');
            $table->timestamps();


            $table->foreign('produit_id')->references('id')->on('produits');
            $table->foreign('entree_id')->references('id')->on('entrees');
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
        Schema::dropIfExists('entree_produits');
    }
}
