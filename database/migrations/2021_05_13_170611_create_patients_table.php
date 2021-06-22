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
            $table->string('photo',  150)->nullable();
            $table->string('name', 45);
            $table->char('gender', 1)->nullable();
            $table->smallInteger('age')->nullable();
            $table->string('phone', 20);
            $table->string('password');
            $table->string('phone_cellphone', 20)->nullable();
            $table->string('email', 80)->unique();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->bigInteger('region_id')->unsigned()->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->string('postcode',20)->nullable();
            $table->string('emergency_contact', 80)->nullable();
            $table->string('contact_phone_number', 20)->nullable();
            $table->string('lang')->nullable();
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
