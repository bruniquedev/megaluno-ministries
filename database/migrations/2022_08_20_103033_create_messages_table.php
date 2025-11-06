<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
        $table->id();//manually added                   
            $table->string('sendername')->nullable();//manually added
            $table->string('sendermail')->nullable();//manually added
            $table->string('phonenumber')->nullable();//manually added
            $table->string('subject',200)->nullable();//manually added
            $table->string('messagetext')->nullable();//manually added
            $table->string('messagedate')->nullable();//manually added
            $table->integer('seenstatus')->nullable();//manually added
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
