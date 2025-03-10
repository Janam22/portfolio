<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->string('f_name',100)->nullable();
            $table->string('l_name',100)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('email',100)->unique();
            $table->string('image',100)->nullable();
            $table->string('password',100);
            $table->tinyInteger('status', 1)->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->bigInteger('role_id', 20)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
