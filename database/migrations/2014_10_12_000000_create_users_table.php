<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique(); 
            $table->string('name')->nullable();                               
            $table->string('password')->nullable();                   
            $table->string('email')->nullable(); 
            $table->string('remark')->nullable(); 
            $table->unsignedInteger('country')->nullable();                   
            $table->unsignedInteger('language')->nullable();                   
            $table->unsignedInteger('role_id');              
            $table->unsignedInteger('company_id')->nullable();              
            $table->unsignedInteger('status')->default(getConfig('user.status.active'));
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
        Schema::dropIfExists('users');
    }
}
