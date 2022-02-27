<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHormonesApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hormones_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('application_id')->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->string('how_along_time')->nullable();
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('hormones_applications', function($table) {
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hormones_applications');
    }
}
