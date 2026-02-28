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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->name('depenses_users_foreign');
            $table->foreignId('colocation_id')->constrained('colocations')->onDelete('cascade')->name('depenses_colocations_foreign');       
            $table->foreignId('categorie_id')->constrained('categories')->name('depenses_categories_foreign');       
            $table->string('titre');
            $table->decimal('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
