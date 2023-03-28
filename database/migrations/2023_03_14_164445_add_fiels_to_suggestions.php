<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFielsToSuggestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->decimal('unitario', 16, 2)->nullable();
            $table->decimal('dr_fee', 16, 2)->nullable();
            $table->boolean('is_free')->nullable()->default(0);
            $table->bigInteger('quote_id')->unsigned()->nullable();
        });

        Schema::table('suggestions', function($table) {
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->dropForeign(['quote_id']);
            $table->dropColumn('unitario');
            $table->dropColumn('dr_fee');
            $table->dropColumn('is_free');
            $table->dropColumn('quote_id');
        });
    }
}
