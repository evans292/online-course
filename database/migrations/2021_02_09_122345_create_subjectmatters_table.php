<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectmattersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjectmatters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->string('title');
            $table->text('details');
            $table->string('path');
            $table->string('link');
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
        Schema::dropIfExists('subjectmatters');
    }
}
