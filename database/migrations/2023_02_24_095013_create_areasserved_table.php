<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasservedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areasserved', function (Blueprint $table) {
          
         $table->id();//manually added                   
            $table->string('headingtext',200)->nullable();//manually added
            $table->text('descriptiontext')->nullable();//manually added
            $table->mediumText('areamapcode')->nullable();//manually added
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areasserved');
    }
}
