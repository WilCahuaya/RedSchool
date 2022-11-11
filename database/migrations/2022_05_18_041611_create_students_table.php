<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('tutors_id')->unsigned();
            $table->string('DNI');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('number_phone');
            $table->boolean('is_active');
            $table->timestamps();

            // $table->foreign('tutors_id')->references('id')->on('tutors')->onDelete("cascade");
            $table->unsignedBigInteger('tutors_id');
            $table->foreign('tutors_id')->references('id')->on('tutors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
