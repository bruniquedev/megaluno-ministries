<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
          $table->id();//manually added                   
            $table->text('descriptiontext')->nullable();//manually added
            $table->text('keywordstext')->nullable();//manually added
            $table->text('author')->nullable();//manually added
            $table->text('title')->nullable();//manually added
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo');
    }
}
