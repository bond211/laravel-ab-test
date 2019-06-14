<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateABTestsTable extends Migration
{
    public function up()
    {
        Schema::create('a_b_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('a_b_tests');
    }
}
