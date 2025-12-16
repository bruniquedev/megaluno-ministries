<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
 $table->integer('contentinfo_id')->default(0);           
$table->text('reference')->nullable();
$table->decimal('amount',11,2)->default(0); 
$table->integer('donationstatus')->default(0); 
$table->string('donorname',200)->nullable();    
$table->string('donoremail',200)->nullable(); 
$table->string('donorphonenumber',200)->nullable();
$table->text('addondetails')->nullable();
$table->string('createddate',200)->nullable();
$table->integer('status')->default(0);
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
        Schema::dropIfExists('donations');
    }
}
