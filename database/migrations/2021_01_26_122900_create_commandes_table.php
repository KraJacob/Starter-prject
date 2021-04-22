<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_commande');
            $table->string('observation');
            $table->date('date_commande');
            $table->string('montant_total');
            $table->unsignedInteger('type_commande_id');
            $table->unsignedInteger('agence_id')->nullable();;
            $table->enum('statut', ['ACTIVE','SUPPRIMER'])->default('ACTIVE');
            $table->integer('created_by')->nullable();
            $table->timestamps();


            $table->foreign('agence_id')->references('id')->on('agences');
            $table->foreign('type_commande_id')->references('id')->on('type_commandes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
