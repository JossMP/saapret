<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('career_id')->deleteOnCascade();
            $table->foreignId('person_id')->deleteOnCascade();
            $table->foreignId('degree_id')->nullable();
            $table->string('title')->nullable();
            $table->string('title_num')->nullable();
            $table->string('mention')->nullable();
            $table->integer('start_year')->nullable();
            $table->integer('end_year')->nullable();
            $table->date('date_issued')->nullable();
            $table->string('file')->nullable();
            $table->boolean('published')->default(false);
            $table->unsignedInteger('order')->default(1);

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
        Schema::dropIfExists('professionals');
    }
}
