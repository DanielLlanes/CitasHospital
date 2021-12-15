<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerObjetiveStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_objetive_staff', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned()->nullable();
            $table->text('career_objective');
            $table->timestamps();
        });
        Schema::table('career_objetive_staff', function($table) {
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
        Schema::dropIfExists('career_objetive_staff');
    }
}
