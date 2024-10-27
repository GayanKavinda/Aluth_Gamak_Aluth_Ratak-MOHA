<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//Developed by G.R Gayan Kavinda Gamlath 
//gayankavinda98v.lk@gmail.com
//2024 SLIIT Internship 
//Ministry of Home Affairs (MOHA)

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
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable(); // Add user_id column
            $table->bigInteger('receiver_id')->unsigned()->nullable(); // You already have receiver_id
            $table->string('district')->nullable();
            $table->string('workplace')->nullable();
            $table->string('subject');
            $table->text('body');
            $table->string('email')->nullable();
            $table->timestamps();
        
            // Define foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Define foreign key constraint for receiver_id
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the 'email' column if it exists
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'email')) {
                $table->dropColumn('email');
            }
        });

        // Drop the 'receiver_id' column if it exists
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'receiver_id')) {
                $table->dropForeign(['receiver_id']);
                $table->dropColumn('receiver_id');
            }
        });

        // Drop the entire 'messages' table
        Schema::dropIfExists('messages');
    }
}
