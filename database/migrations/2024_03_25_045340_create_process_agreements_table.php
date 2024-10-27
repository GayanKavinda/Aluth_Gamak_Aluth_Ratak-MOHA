<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//Developed by G.R Gayan Kavinda Gamlath 
//gayankavinda98v.lk@gmail.com
//2024 SLIIT Internship 
//Ministry of Home Affairs (MOHA)

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('process_agreements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            // Define other columns
            $table->string('field');
            $table->string('task');
            $table->string('performance_indicator')->nullable();
            $table->decimal('contracted_target', 10, 2)->nullable();
            $table->decimal('first_quarter', 10, 2)->nullable();
            $table->decimal('second_quarter', 10, 2)->nullable();
            $table->decimal('third_quarter', 10, 2)->nullable();
            $table->decimal('fourth_quarter', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->timestamps();
        
            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_agreements');
    }
};
