<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_ones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->integer('statusOneable_id')->unsigned();
            $table->string('statusOneable_type');
            $table->text('indications')->nullable();
            $table->text('recomendations')->nullable();
            $table->text('reason')->nullable();
            $table->string('code');
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
        Schema::dropIfExists('status_ones');
    }
}
