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
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('last_name');
            $table->string('photo')->nullable();
            $table->date('birthday');
            $table->enum('doc_type', ['DNI', 'CE', 'Pasaporte', 'Otros']);
            $table->string('doc_num', 16);
            $table->unsignedInteger('location_home'); //ubigeo
            $table->unsignedInteger('location_birth'); //ubigeo
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('slug')->unique();
            $table->boolean('published')->default(false);
            $table->boolean('verified')->default(false);

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
        Schema::dropIfExists('people');
    }
}
