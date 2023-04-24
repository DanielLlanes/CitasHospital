<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_emails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned()->nullable();
            $table->bigInteger('service_id')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->boolean('selected')->nullable();
            $table->integer('additional_emailable_id')->unsigned();
            $table->string('additional_emailable_type');
            $table->timestamps();
        });

        Schema::table('additional_emails', function($table) {
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['staff_id']);
        Schema::dropIfExists('additional_emails');
    }
}
