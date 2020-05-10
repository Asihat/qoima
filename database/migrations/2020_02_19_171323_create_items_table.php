<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('length')->default('');
            $table->string('width')->default('');
            $table->string('height')->default('');
            $table->string('amount')->default('1');
            $table->double('price')->default(100.00);
            $table->integer('user_id');
            $table->integer('qoima_id');
            $table->integer('status')->comment('0 = default(now created), 1 = in qoima, 2 = in the way to qoima, 3 = in the way to home, 10 = error');

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
        Schema::dropIfExists('items');
    }
}
