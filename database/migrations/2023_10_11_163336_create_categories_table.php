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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('parent_id')->constrained('categories');
            $table->string('tags')->nullable()->comment('this field is for the SEO of webpage to find the category better');
            $table->tinyInteger('status')->default(0)->comment("0 => don't display 1 => show the category");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
