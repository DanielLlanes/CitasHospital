<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->unsigned()->nullable();
            $table->string('name_es');
            $table->string('name_en');
            $table->boolean('active')->default(true);
            $table->boolean('show')->default(true);
            $table->timestamps();
        });
        Schema::table('specialties', function($table) {
           $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('staff', function($table) {
           $table->foreign('Specialty_id')->references('id')->on('specialties')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['role_id']);
        $table->dropColumn('role_id');
        Schema::dropIfExists('specialties');
    }
}
