<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_details', function (Blueprint $table) {
            $table->id();
             $table->integer('related_id')->nullable();//manually added
     $table->string('heading')->nullable();//manually added
    $table->text('description')->nullable();//manually added
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities_details');
    }
}
