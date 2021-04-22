<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('libelle')->nullable();
            $table->string('commentaire')->nullable();
            $table->string('destination');
            $table->date('date_livraison');
            $table->unsignedInteger('commande_id');
            $table->unsignedInteger('livrreur_id');
            $table->unsignedInteger('agence_id')->nullable();;
            $table->enum('statut', ['ACTIVE','SUPPRIMER'])->default('ACTIVE');
            $table->integer('created_by')->nullable();
            $table->timestamps();

            $table->foreign('agence_id')->references('id')->on('agences');
            $table->foreign('commande_id')->references('id')->on('commandes');
            $table->foreign('livrreur_id')->references('id')->on('livreurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livraisons');
    }
}
