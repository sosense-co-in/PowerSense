<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the contact
            $table->string('email')->nullable(); // Email of the contact
            $table->string('phone')->nullable(); // Phone number
            $table->foreignId('account_id')->nullable()->constrained('accounts')->onDelete('cascade'); // Foreign key to accounts
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // User who created the contact
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null'); // User who updated the contact
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
