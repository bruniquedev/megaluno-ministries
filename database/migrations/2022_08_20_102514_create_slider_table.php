<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->id();//manually added                   
            $table->mediumText('text')->nullable();//manually added 
            $table->string('filename')->nullable();//manually added
            $table->string('headingtext',200)->nullable();//manually added
            $table->string('buttontext',100)->nullable();//manually added
            $table->mediumText('buttonlink')->nullable();//manually added
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider');
    }
}
