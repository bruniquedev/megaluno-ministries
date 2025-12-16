<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
                $table->id();//manually added                   
            $table->string('name')->nullable();//manually added
            $table->string('email')->nullable();//manually added
            $table->string('mobile')->nullable();//manually added
            $table->string('location')->nullable();//manually added
        $table->string('admintype')->nullable();//manually added
            $table->string('username')->nullable();//manually added
            $table->text('password')->nullable();//manually added
            $table->string('regdate')->nullable();//manually added
            $table->string('status')->nullable();//manually added
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
        Schema::dropIfExists('admin');
    }
}
