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
            $table->string('username');
            $table->string('cellphone');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->char('lang')->default('es');
            $table->boolean('active')->default(true);
            $table->boolean('show')->default(true);
            $table->boolean('set_pass')->default(false);
            $table->string('color')->unique();
            $table->timestamp('last_assignment')->default(date("Y-m-d H:i:s"));
            $table->text('url')->nullable();
            $table->boolean('public_profile')->default(false);
            $table->rememberToken();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('staff');
        Schema::enableForeignKeyConstraints();
    }
}
