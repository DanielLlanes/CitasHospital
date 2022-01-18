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
            $table->string('name');
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->smallInteger('age')->nullable();
            $table->string('phone')->unique();
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('ecn')->nullable();
            $table->string('ecp')->nullable();
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
