<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description_ones', function (Blueprint $table) {
            $table->id();
            $table->text('description_en')->nullable();
            $table->text('description_es')->nullable();
            $table->integer('descriptionOneable_id')->unsigned();
            $table->string('descriptionOneable_type');
            $table->text('code')->nullable();
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
        Schema::dropIfExists('description_ones');
    }
}
