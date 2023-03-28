<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFielsToQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('cotizacion')->nullable();
            $table->decimal('price', 16, 2)->nullable();
            $table->text('code')->nullable();
            $table->bigInteger('applications_id')->unsigned()->nullable();
        });

        Schema::table('quotes', function($table) {
            $table->foreign('applications_id')->references('id')->on('applications')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropForeign(['applications_id']);
             $table->dropColumn('price'); 
             $table->dropColumn('code');
        });
    }
}
