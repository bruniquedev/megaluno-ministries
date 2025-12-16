<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
$table->id();//manually added                   
$table->string('name',200)->nullable();//manually added 
$table->string('job_title',200)->nullable();
$table->string('email',200)->nullable();//manually added  
$table->string('reviewdate',200)->nullable();//manually added    
$table->mediumText('descriptiontext')->nullable();//manually added
$table->integer('status')->default(0);//manually added
$table->integer('ratings')->default(0);//manually added
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
        Schema::dropIfExists('testimonials');
    }
}
