<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDegreesObtainedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degrees_obtaineds', function (Blueprint $table) {
            $table->id();

            $table->foreignId('degree_id')->deleteOnCascade();
            $table->string('mention')->nullable();
            $table->string('title')->nullable();
            $table->string('title_num')->nullable();
            $table->string('institution')->nullable();
            $table->integer('start_year')->nullable();
            $table->integer('end_year')->nullable();
            $table->date('date_issued')->nullable();
            $table->string('file')->nullable();
            $table->boolean('published')->default(false);
            $table->unsignedInteger('order')->default(1);

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
        Schema::dropIfExists('degrees_obtaineds');
    }
}
