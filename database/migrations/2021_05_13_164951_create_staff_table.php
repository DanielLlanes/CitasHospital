<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('cellphone');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->char('lang')->default('es');
            $table->string('avatar')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('show')->default(true);
            $table->boolean('set_pass')->default(false);
            $table->string('color')->nullable();
            $table->bigInteger('specialty_id')->unsigned()->nullable();
            $table->timestamp('last_assignment')->default(date("Y-m-d H:i:s"));
            $table->rememberToken();
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
        Schema::dropIfExists('staff');
    }
}
