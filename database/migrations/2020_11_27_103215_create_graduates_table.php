<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('career_id')->constrained()->deleteOnCascade(); // Carrera
            $table->foreignId('person_id')->constrained()->deleteOnCascade(); // Datos Personales
            $table->foreignId('degree_id')->nullable(); // Grado Obtenido
            $table->string('title')->nullable(); // Titulo otorgado (ejemplo: Abogado, Arquitecto) (no nesesario \ incluido en carrera)
            $table->string('title_num')->nullable(); // Numero de titulo
            $table->string('mention')->nullable(); // Mension que figura en el titulo prof.
            $table->integer('start_year')->nullable();
            $table->integer('end_year')->nullable();
            $table->date('date_issued')->nullable(); // Fecha de expedicion del titulo
            $table->string('file')->nullable(); // Archivo de documento validatorio
            $table->boolean('published')->default(false); // si se publica
            $table->unsignedInteger('order')->default(1); // orden

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graduates');
    }
}
