<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_details', function (Blueprint $table) {
            $table->id();
            $table->integer('related_id')->default(0);
            $table->string('titlelist')->nullable();
            $table->string('headinglist')->nullable();
            $table->string('sluglist')->nullable();
            $table->text('descriptionlist')->nullable();
            $table->mediumText('filenamelist')->nullable();
            $table->integer('file_widthlist')->default(0);
            $table->integer('file_heightlist')->default(0);
            $table->mediumText('iconfilelist')->nullable();
            $table->integer('icon_widthlist')->default(0);
            $table->integer('icon_heightlist')->default(0);
            $table->mediumText('video_filelist')->nullable();
            $table->mediumText('link_redirectlist')->nullable();
            $table->decimal('pricelist',10, 2)->default(0);
            $table->enum('ispublishedlist', [1,0])->default('1');
            $table->integer('ordersort')->default(0);
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
        Schema::dropIfExists('content_details');
    }
}
