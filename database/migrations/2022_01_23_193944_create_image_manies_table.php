<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageManiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_manies', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('image');
            $table->text('type')->nullable();
            $table->integer('order')->nullable();
            $table->integer('imageManyable_id')->unsigned();
            $table->string('imageManyable_type');
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
        Schema::dropIfExists('image_manies');
    }
}
