<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurgeryPerformedStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgery_performed_staff', function (Blueprint $table) {
            $table->bigInteger('staff_id')->unsigned()->nullable();
            $table->string('surgery_title');
            $table->integer('surgery_number');
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('surgery_performed_staff', function($table) {
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
        Schema::dropIfExists('surgery_performed_staff');
    }
}
