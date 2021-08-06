<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->string('service_en');
            $table->string('service_es');
            $table->boolean('need_images')->default(false);
            $table->integer('qty_images')->default(0);
            $table->boolean('active')->default(true);
            $table->longText('description_en')->nullable();
            $table->longText('description_es')->nullable();
            $table->string('url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('services', function($table) {
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['brand_id']);
        $table->dropColumn('brand_id');
        Schema::dropIfExists('services');
    }
}
