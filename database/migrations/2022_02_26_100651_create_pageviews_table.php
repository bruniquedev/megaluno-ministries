<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pageview', function (Blueprint $table) {
            $table->id();//manually added   	           	
            $table->string('page')->nullable();//manually added	
            $table->string('userip')->nullable();//manually added	
             $table->string('country')->nullable();;//manually added	
              $table->string('city')->nullable();//manually added	
              $table->string('countrycode')->nullable();//manually added
              $table->string('latitude')->nullable();//manually added
              $table->string('longitude')->nullable();//manually added
              $table->string('visitdate')->nullable();//manually added
              $table->integer('sorted_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pageview');
    }
}
