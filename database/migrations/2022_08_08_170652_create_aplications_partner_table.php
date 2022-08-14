<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicationsPartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplications_partner', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('application_id')->unsigned()->nullable();
            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->string('code');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('aplications_partner', function($table) {
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('partner_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aplications_partner');
    }
}
