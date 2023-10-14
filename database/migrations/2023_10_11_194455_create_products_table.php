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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->string('slug')->unique()->nullable();
            $table->string('tags')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('user_id')->constrained('users');
            $table->tinyInteger('status')->default(0)->comment("0 => the product isn't allowed to be shown 1 => the product is allowed");
            $table->tinyInteger('marketable')->default(0)->comment("0 => the product isn't allowed to sell 1 => the product is allowed");
            $table->text('image')->nullable();
            $table->string('price');
            $table->unsignedBigInteger('sold_number')->default(0);
            $table->unsignedBigInteger('frozen_number')->default(0);
            $table->unsignedBigInteger('marketable_number')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
