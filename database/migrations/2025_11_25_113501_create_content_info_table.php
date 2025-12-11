<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_info', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('heading')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->mediumText('link_redirect')->nullable();
            $table->mediumText('filename')->nullable();
            $table->integer('file_width')->default(0);
            $table->integer('file_height')->default(0);
            $table->mediumText('iconfile')->nullable();
            $table->integer('icon_width')->default(0);
            $table->integer('icon_height')->default(0);
            $table->mediumText('featured_video')->nullable();
            $table->decimal('price',10, 2)->default(0);
            $table->string('day_date')->nullable();
            $table->string('time_of_date')->nullable();
            $table->integer('post_views')->default(0);
            $table->enum('ispublished', [1,0])->default('1');
            $table->string('publisher')->nullable();
            $table->string('page_area_type')->nullable();
            $table->integer('sorted_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_info');
    }
}
