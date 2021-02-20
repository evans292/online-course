<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentIdToSchoolclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schoolclasses', function (Blueprint $table) {
            //
            $table->foreignId('department_id')->nullable()->after('teacher_id')->constrained('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schoolclasses', function (Blueprint $table) {
            //
        });
    }
}
