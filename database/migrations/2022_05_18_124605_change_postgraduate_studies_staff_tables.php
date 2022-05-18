<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePostgraduateStudiesStaffTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postgraduate_studies_staff', function (Blueprint $table) {
            $table->dropColumn(['postgraduate_from_year', 'postgraduate_to_year']);
        });
        
        Schema::table('postgraduate_studies_staff', function (Blueprint $table) {
            $table->integer('postgraduate_from_year')->nullable();
            $table->integer('postgraduate_to_year')->nullable();
            $table->text('postgraduate_notes')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postgraduate_studies_staff', function (Blueprint $table) {
            $table->integer('postgraduate_from_year')->nullable();
            $table->integer('postgraduate_to_year')->nullable();
            $table->text('postgraduate_notes')->nullable()->change();
        });
    }
}
