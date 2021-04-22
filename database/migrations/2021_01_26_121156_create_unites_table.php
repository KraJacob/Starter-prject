<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle')->unique();
            $table->string('code')->unique();
            $table->unsignedInteger('agence_id')->nullable();
            $table->enum('statut', ['ACTIVE','SUPPRIMER'])->default('ACTIVE');
            $table->integer('created_by')->nullable();
            $table->timestamps();

           // $table->foreign('agence_id')->references('id')->on('agences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unites');
    }
}
