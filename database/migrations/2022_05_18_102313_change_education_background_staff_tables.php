<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEducationBackgroundStaffTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('education_background_staff', 'education_to_year') && Schema::hasColumn('education_background_staff', 'education_from_year')){
            Schema::table('education_background_staff', function (Blueprint $table) {
                $table->dropColumn(['education_from_year', 'education_to_year']);
            });
        }

        Schema::table('education_background_staff', function (Blueprint $table) {
            $table->integer('education_from_year')->nullable();
            $table->integer('education_to_year')->nullable();
            $table->text('education_notes')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_background_staff', function (Blueprint $table) {
            $table->integer('education_from_year')->nullable();
            $table->integer('education_to_year')->nullable();
            $table->text('education_notes')->nullable()->change();
        });
    }
}
