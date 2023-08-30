<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->date('date_of_birth');
            
            // Store phone number as a big integer
            $table->bigInteger('phone_number')->unsigned();
            
            // Store email as a string with a limited length
            $table->string('email', 255)->unique();
            
            // Depending on the format and length of bank account numbers, choose the appropriate column type
            $table->string('bank_account_number', 50); // Adjust as needed
    
            $table->timestamps();
            
            // Add a unique constraint for firstname, lastname, and date_of_birth
            $table->unique(['firstname', 'lastname', 'date_of_birth']);
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
