<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tareas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nombre');
			$table->date('fechaInicio');
			$table->date('fechaFin');
			$table->enum('estado', array('INICIADA', 'EN PROCESO', 'CANCELADA', 'COMPLETADA'));
			$table->integer('idUser');
			$table->foreign('idUser')->references('id')->on('users')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
