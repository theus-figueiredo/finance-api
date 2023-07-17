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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->float('value', 10, 2);
            $table->date('date');
            $table->text('description');
            $table->unsignedBIgInteger('income_category_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('income_category_id')->references('id')->on('income_category');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
