<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUpdateWorkHistoryStaffTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_history_staff', function (Blueprint $table) {
            $table->dropColumn(['job_from_year', 'job_to_year']);
        });
        Schema::table('work_history_staff', function (Blueprint $table) {
            $table->integer('job_from_year')->nullable();
            $table->integer('job_to_year')->nullable();
            $table->text('job_notes')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_history_staff', function (Blueprint $table) {
            $table->integer('job_from_year')->nullable();
            $table->integer('job_to_year')->nullable();
            $table->text('job_notes')->nullable()->change();
        });
    }
}
