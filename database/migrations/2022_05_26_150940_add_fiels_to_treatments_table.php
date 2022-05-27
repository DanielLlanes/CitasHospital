<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFielsToTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->boolean('starting')->default(false);
            $table->decimal('discount', 6, 2)->nullable()->change();
            $table->string('discountType')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->boolean('starting')->default(false);
            $table->decimal('discount', 6, 2)->nullable()->change();
            $table->string('discountType')->nullable();
        });
    }
}
