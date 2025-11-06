<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aboutinfo', function (Blueprint $table) {
      $table->id();//manually added                   
            $table->string('headingtext')->nullable();//manually added
            $table->string('filename')->nullable();//manually added
            $table->integer('widthsize')->nullable();//manually added
            $table->integer('heightsize')->nullable();//manually added

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aboutinfo');
    }
}
