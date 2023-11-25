<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2);
            $table->enum('transaction_type', ['deposit', 'withdraw', 'transfer']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('from_account_id')->nullable()->constrained('accounts')->onDelete('cascade');
            $table->foreignId('to_account_id')->nullable()->constrained('accounts')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
