<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurgeryApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgery_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('application_id')->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->integer('year')->nullable();
            $table->text('complications')->nullable();
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('surgery_applications', function($table) {
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
        Schema::dropIfExists('surgery_applications');
    }
}
