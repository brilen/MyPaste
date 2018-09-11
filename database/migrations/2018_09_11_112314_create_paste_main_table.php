<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasteMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paste_main', function (Blueprint $table) {
            $table->increments('id');
            $table->text('code');
            $table->string('expire_time', 6);
            $table->boolean('private');
            $table->string('name', 60);
            $table->boolean('access_all');
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
        Schema::drop('paste_main');
    }
}
