<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicesinfo', function (Blueprint $table) {
             $table->id();//manually added                   
            $table->text('name')->nullable();//manually added
            $table->text('heading')->nullable();//manually added
            $table->text('filename')->nullable();//manually added
            $table->text('widthsize')->nullable();//manually added
            $table->text('heightsize')->nullable();//manually added

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicesinfo');
    }
}
