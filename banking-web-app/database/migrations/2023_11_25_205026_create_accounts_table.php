<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number', 10)->unique();
            $table->decimal('balance', 10, 2);
            $table->enum('currency', ['USD', 'EUR', 'LBP']);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['active', 'pending', 'blocked'])->default('pending');
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
        Schema::dropIfExists('accounts');
    }
}
