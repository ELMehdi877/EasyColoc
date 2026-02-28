<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_payments', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained('users')->name('users_payments_users_foreign');
            $table->foreignId('payment_id')->constrained('payments')->name('users_payments_payments_foreign');
            $table->unique(['user_id', 'payment_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
