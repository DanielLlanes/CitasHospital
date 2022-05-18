<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUpdateCourseStaffTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('update_course_staff', function (Blueprint $table) {
            $table->dropColumn('course_year');
        });
        Schema::table('update_course_staff', function (Blueprint $table) {
            $table->integer('course_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('update_course_staff', function (Blueprint $table) {
            $table->integer('course_year')->nullable();
        });
    }
}
