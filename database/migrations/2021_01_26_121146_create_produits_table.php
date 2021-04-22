<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref');
            $table->string('nom');
            $table->integer('qte_init')->default(0);
            $table->integer('qte_stock')->default(0);
            $table->integer('prix_unitaire')->nullable();
            $table->unsignedInteger('agence_id')->nullable();
            $table->unsignedInteger('type_produit_id');
            $table->enum('statut', ['ACTIVE','SUPPRIMER'])->default('ACTIVE');
            $table->integer('created_by')->nullable();
            $table->timestamps();

            $table->foreign('agence_id')->references('id')->on('agences');
            $table->foreign('type_produit_id')->references('id')->on('type_produits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
