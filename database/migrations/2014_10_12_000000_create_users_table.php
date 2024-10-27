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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('position')->nullable();
            $table->string('workplace')->nullable();
            $table->date('date_of_appointment')->nullable();
            $table->string('district')->nullable(); // Add the district field
            $table->string('telephone')->nullable(); // Add telephone field
            $table->string('ga_email')->nullable(); // Add ga_email field
            $table->integer('num_divisional_secretariats')->nullable();
            $table->integer('num_village_officer_domains')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
