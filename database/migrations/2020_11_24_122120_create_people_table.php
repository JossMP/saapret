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
            $table->string('doc_num', 16)->unique();
            $table->string('marital_status')->nullable()->default('Soltero(a)');

            // ubigeo address
            $table->unsignedBigInteger('location_home')->nullable();
            $table->foreign('location_home')->references('id')->on('districts');
            // ubigeo birth
            $table->unsignedBigInteger('location_birth')->nullable();
            $table->foreign('location_birth')->references('id')->on('districts');

            // linked User
            $table->foreignId('user_id')->nullable();

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
