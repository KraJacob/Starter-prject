<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('contact')->nullable();
            $table->string('adresse')->nullable();
            $table->unsignedInteger('agence_id');
            $table->unsignedInteger('type_client_id');
            $table->enum('statut', ['ACTIVE','SUPPRIMER','DESACTIVE'])->default('ACTIVE');
            $table->integer('created_by')->nullable();
            $table->timestamps();

            $table->foreign('agence_id')->references('id')->on('agences');
            $table->foreign('type_client_id')->references('id')->on('type_clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
