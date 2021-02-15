<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolclassTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolclass_teacher', function (Blueprint $table) {
            $table->foreignId('schoolclass_id')->constrained('schoolclasses');
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->primary(['schoolclass_id', 'teacher_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schoolclass_teacher');
    }
}
