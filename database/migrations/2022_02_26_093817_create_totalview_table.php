<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('totalview', function (Blueprint $table) {
            $table->id();//manually added		           	
            $table->string('page')->nullable();//manually added	
            $table->bigInteger('totalvisit')->default(0);//manually added
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('totalview');
    }
}
