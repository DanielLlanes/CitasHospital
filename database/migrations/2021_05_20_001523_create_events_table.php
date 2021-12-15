<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->bigInteger('staff_id')->unsigned()->nullable();
            $table->bigInteger('patient_id')->unsigned()->nullable();
            $table->bigInteger('application_id')->unsigned()->nullable();
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('active')->default(true);
            $table->text('note')->nullable();
            $table->boolean('is_application')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('events', function($table) {
             $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('events', function($table) {
             $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
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
        $table->dropColumn('staff_id');
        $table->dropForeign(['patient_id']);
        $table->dropColumn('patient_id');
        Schema::dropIfExists('events');
    }
}
