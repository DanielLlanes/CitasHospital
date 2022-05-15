<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_ones', function (Blueprint $table) {
            $table->id();
            $table->text('video');
            $table->integer('videoOneable_id')->unsigned();
            $table->string('videoOneable_type');
            $table->string('code');
            $table->string('mime');
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
        Schema::dropIfExists('video_ones');
    }
}
