<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostgraduateStudiesStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postgraduate_studies_staff', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned()->nullable();
            $table->string('postgraduate_school');
            $table->string('postgraduate_title');
            $table->date('postgraduate_from_year');
            $table->date('postgraduate_to_year');
            $table->text('postgraduate_notes');
            $table->timestamps();
        });
        Schema::table('postgraduate_studies_staff', function($table) {
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
        Schema::dropIfExists('postgraduate_studies_staff');
    }
}
