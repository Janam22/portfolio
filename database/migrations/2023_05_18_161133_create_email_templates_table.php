<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->string('title',100)->nullable();
            $table->text('body')->nullable();
            $table->string('background_image',100)->nullable();
            $table->string('image',100)->nullable();
            $table->string('logo',100)->nullable();
            $table->string('icon',100)->nullable();
            $table->string('button_name',100)->nullable();
            $table->string('button_url')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('copyright_text')->nullable();
            $table->string('type')->nullable();
            $table->string('email_type')->nullable();
            $table->string('email_template')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_templates');
    }
}
