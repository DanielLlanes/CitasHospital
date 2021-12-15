<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkHistoryStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_history_staff', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned()->nullable();
            $table->string('job_company');
            $table->string('job_title');
            $table->date('job_from_year');
            $table->date('job_to_year');
            $table->text('job_notes');
            $table->timestamps();
        });
        Schema::table('work_history_staff', function($table) {
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
        Schema::dropIfExists('work_history_staff');
    }
}
