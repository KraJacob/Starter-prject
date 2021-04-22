<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle');
            $table->text('commentaire')->nullable();
            $table->unsignedInteger('agence_id')->nullable();;
            $table->unsignedInteger('fournisseur_id');
            $table->enum('statut', ['ACTIVE','SUPPRIMER'])->default('ACTIVE');
            $table->integer('created_by')->nullable();
            $table->timestamps();

            $table->foreign('agence_id')->references('id')->on('agences');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrees');
    }
}
