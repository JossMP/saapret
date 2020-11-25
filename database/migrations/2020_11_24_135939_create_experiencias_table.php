<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencias', function (Blueprint $table) {
            $table->id();

            $table->string('position');
            $table->string('institution')->nullable();
            $table->string('task')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('published')->default(false);
            $table->unsignedInteger('order')->default(1);

            $table->foreignId('person_id')->deleteOnCascade();

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
        Schema::dropIfExists('experiencias');
    }
}
