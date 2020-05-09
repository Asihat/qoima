<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_photo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userID');
            $table->string('photoOne');
            $table->string('photoTwo');
            $table->string('photoThree');
            $table->string('photoFour');
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
        Schema::dropIfExists('users_photo');
    }
}
