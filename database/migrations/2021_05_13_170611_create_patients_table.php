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
            $table->text('photo')->nullable();
            $table->string('name');
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->smallInteger('age')->nullable();
            $table->string('phone');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('region_id')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->bigInteger('region_id')->unsigned()->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->string('postcode')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('contact_phone_number')->nullable();
            $table->string('lang')->nullable();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
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
