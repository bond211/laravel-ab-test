<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateABTestVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('a_b_test_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();

            $table->integer('a_b_test_id')->unsigned();

            $table->integer('count')->unsigned()->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('a_b_test_variants');
    }
}
