<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); 
            $table->string('user_name'); 
            $table->string('email')->unique(); 
            $table->text('content')->nullable(); 
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable(); 
            $table->timestamps();
            $table->index('email', 'users_email_unique'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
