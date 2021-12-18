<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_student');
            $table->string('institution_name');
            $table->integer('id_institution_type');
            $table->integer('year_graduation');
            $table->string('bachelor_title');
            $table->date('icfes_date');
            $table->string('snp_register');
            $table->integer('icfes_score');
            $table->boolean('graduate');
            $table->boolean('graduate_schooling');
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
        Schema::dropIfExists('academic_dates');
    }
}