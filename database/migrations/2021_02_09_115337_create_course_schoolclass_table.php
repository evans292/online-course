<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSchoolclassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_schoolclass', function (Blueprint $table) {
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('schoolclass_id')->constrained('schoolclasses');
            $table->primary(['course_id', 'schoolclass_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_schoolclass');
    }
}
