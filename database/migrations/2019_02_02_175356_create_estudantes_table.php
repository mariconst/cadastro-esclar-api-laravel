<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);   
            $table->date('nascimento');
            $table->integer('serie');
            $table->integer('id_endereco')->unsigned();
            
            $table->integer('id_mae')->unsigned();
           
            $table->timestamps();
        });
        Schema::table('estudantes', function($table) {
            $table->foreign('id_endereco')->references('id')->on('enderecos');
            $table->foreign('id_mae')->references('id')->on('maes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudantes');
    }
}
