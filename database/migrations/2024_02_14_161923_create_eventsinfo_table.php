<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventsinfo', function (Blueprint $table) {
            $table->id();
              $table->string('headingtext')->nullable();//manually added
            $table->text('descriptiontext')->nullable();//manually added
            $table->string('filename')->nullable();//manually added
            $table->integer('widthsize')->nullable();//manually added
            $table->integer('heightsize')->nullable();//manually added
            $table->integer('status')->default(0);//manually added
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventsinfo');
    }
}
