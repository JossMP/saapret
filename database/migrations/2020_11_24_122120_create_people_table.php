<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Datos Personales
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('last_name');
            $table->string('photo')->nullable();
            $table->date('birthday');
            $table->enum('doc_type', ['DNI', 'CE', 'Pasaporte', 'Otros']);
            $table->string('doc_num', 16);
            $table->string('marital_status')->nullable()->default('Soltero(a)');
            $table->unsignedInteger('location_home'); //ubigeo
            $table->unsignedInteger('location_birth'); //ubigeo
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('slug')->unique(); // name-last_name-doc_num
            $table->boolean('published')->default(false);
            $table->boolean('verified')->default(false);

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
        Schema::dropIfExists('people');
    }
}
