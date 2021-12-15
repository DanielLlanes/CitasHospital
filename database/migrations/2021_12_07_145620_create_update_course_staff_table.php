<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateCourseStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_course_staff', function (Blueprint $table) {
            $table->id();
                $table->bigInteger('staff_id')->unsigned()->nullable();
                $table->string('course_school');
                $table->string('course_title');
                $table->date('course_year');
                $table->timestamps();
            });
            Schema::table('update_course_staff', function($table) {
                $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade')->onUpdate('cascade');
            });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_course_staff');
    }
}
