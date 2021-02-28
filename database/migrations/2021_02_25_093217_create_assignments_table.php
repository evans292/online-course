<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schoolclass_id')->constrained('schoolclasses');
            $table->foreignId('subjectmatter_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->string('title');
            $table->text('instructions')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('point')->nullable();
            $table->date('due');
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
        Schema::dropIfExists('assignments');
    }
}
