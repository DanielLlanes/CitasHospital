<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->boolean('treatmentBefore')->default(false);
            $table->text('avatar')->nullable();
            $table->string('name');
            $table->string('sex');
            $table->date('dob');
            $table->smallInteger('age');
            $table->string('phone');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->string('address');
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->string('city');
            $table->string('zip');
            $table->string('ecn');
            $table->string('ecp');
            $table->string('lang')->defalt('en');
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('patients', function($table) {
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
