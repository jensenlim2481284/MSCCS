<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();        
            $table->string('description')->nullable();        
            $table->string('uid')->unique();                          
            $table->string('audio_path');                          
            $table->string('language')->nullable();                          
            $table->text('transcript')->nullable();                          
            $table->unsignedInteger('status')->default(getConfig('ticket.status.pending'));  
            $table->unsignedInteger('company_id');  
            $table->unsignedInteger('customer_id')->nullable();  
            $table->text('meta')->nullable();            #  Entity , Location, Sentiment result, job stage
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
        Schema::dropIfExists('ticket');
    }
}
