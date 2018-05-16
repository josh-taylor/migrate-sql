<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStubTable extends Migration
{
    public function up()
    {
        Schema::create('stub', function (Blueprint $table) {
           $table->increments('id');
           $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stub');
    }
}
